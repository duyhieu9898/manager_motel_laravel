<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HeaderComposer
{
    /**
     * The category repository implementation.
     *
     * @var CategoryRepository
     */
    protected $categoryRepository;
    /**
     * The user repository implementation.
     *
     * @var CategoryRepository
     */
    protected $userRepository;
    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(CategoryRepositoryInterface $category, UserRepositoryInterface $user)
    {
        // Dependencies automatically resolved by service container...
        $this->categoryRepository = $category;
        $this->userRepository = $user;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $arrData = DB::table('basic_information')->whereIn('name', [
            'home_name',
            'home_header',
            'link_logo_header',
            'slogan_header',
            'link_about_me'
        ])->get()->toArray();
        for ($i=0; $i < count($arrData) ; $i++) {
            $arrData[$arrData[$i]->name] = $arrData[$i]->content;
            unset($arrData[$i]);
        }
        $view->with('dataHeader', $arrData);
        $view->with('categories', $this->categoryRepository->get());

        if (Auth::check()) {
            $view->with('numRoomInCart', $this->userRepository->countRoomsInCartByUserId(Auth::id()));
        }
    }
}
