<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\RepositoryInterface;

/**
 * Class BaseRepository
 *
 * @package App\Repositories
 */
class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritdoc
     */
    public function getAll()
    {
        return $this->model::get();
    }
    public function findById(int $id)
    {
        return $this->model::findOrFail($id);
    }
}
