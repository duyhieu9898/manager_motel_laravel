<?php

namespace App\Http\Controllers;

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
        $rooms=Room::where('active', true);
        $arrBreadcrumb = [];
        if (Input::get('category_id') != 'Chose Category') {
            $rooms = $rooms->where(['category_id'=> Input::get('category_id')]);
            $category = $this->categoryRepository->findById(Input::get('category_id'));

            $arrBreadcrumb[] = "Category is $category->name";
        }
        if (Input::get('name_province')) {
            $nameProvince = Input::get('name_province');
            $province = $this->provinceRepository->findByName($nameProvince);
            $rooms = $rooms->whereHas('address', function ($query) use ($province) {
                $query->where('province_id', $province->id);
            });

            $arrBreadcrumb[]= "Province is $nameProvince";
        }
        if (Input::get('people')) {
            $people = Input::get('people');
            $rooms = $rooms->where('maximum_peoples_number', '>=', $people);

            $arrBreadcrumb[]= "People greater than $people";
        }

        if (Input::get('min_price')) {
            $min_price = $this->formatUserInputPrice(Input::get('min_price'));
            $rooms = $rooms->where('price', '>=', $min_price);

            $arrBreadcrumb[]= "Price greater than $min_price";
        }
        if (Input::get('max_price')) {
            $max_price = $this->formatUserInputPrice(Input::get('max_price'));
            $rooms = $rooms->where('price', '<=', $max_price);
            $arrBreadcrumb[]= "Price less than $max_price";
        }
        $rooms = $rooms->with(['images', 'category'])->paginate(8);
        
        return view('list_room', ['rooms' => $rooms, 'arrBreadcrumb' => $arrBreadcrumb]);
    }
    public function formatUserInputPrice($priceRaw)
    {
        return preg_replace('/[\$\,\s]/', '', $priceRaw);
    }
}
