<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

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

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function get()
    {
        return $this->model::get();
    }

    public function findById(int $id)
    {
        return $this->model::findOrFail($id);
    }

    public function updateById(int $id, array $data)
    {
        return $this->model::findOrFail($id)->update($data);
    }

    public function deleteById(int $id)
    {
        return $this->model::destroy($id);
    }
}
