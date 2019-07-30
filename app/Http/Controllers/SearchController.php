<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Province\ProvinceRepositoryInterface;
use App\Repositories\Address\AddressRepositoryInterface;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    private $categoryRepository;
    private $provinceRepository;
    private $addressRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        ProvinceRepositoryInterface $provinceRepository,
        AddressRepositoryInterface $addressRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->provinceRepository = $provinceRepository;
        $this->addressRepository = $addressRepository;
    }

    public function searchRoom()
    {
        $rooms = Room::where(['category_id'=> Input::get('category_id'), 'active' => true ]);
        if (Input::has('name_province')) {
            $province = $this->provinceRepository->findByName(Input::get('address'));
            $rooms->whereHas('address', function ($query) use ($province) {
                $query->where('province_id', $province->id);
            });
        }

        $rooms = $rooms->whereBetween('price', [Input::get('min_price'), Input::get('max_price')])
            ->with(['images', 'category'])
            ->paginate(8);
        return view('list_room', compact('rooms'));
    }
}
