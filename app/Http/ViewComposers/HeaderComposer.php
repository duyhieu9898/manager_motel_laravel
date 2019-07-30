<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

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
     * @param  CategoryRepository  $users
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
        $view->with('categories', $this->categoryRepository->get());
        if (Auth::check()) {
            $view->with('numRoomInCart', $this->userRepository->countRoomsInCartByUserId(Auth::id()));
        }
    }
}
