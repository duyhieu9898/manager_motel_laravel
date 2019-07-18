<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Category\CategoryRepositoryInterface;

class HeaderComposer
{
    /**
     * The user repository implementation.
     *
     * @var CategoryRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  CategoryRepository  $users
     * @return void
     */
    public function __construct(CategoryRepositoryInterface $category)
    {
        // Dependencies automatically resolved by service container...
        $this->categoryRepository = $category;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->categoryRepository->getAll());
    }
}
