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
    /**
     * create new
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        return $this->model::create($data);
    }
    /**
     * get all
     *
     * @return void
     */
    public function get()
    {
        return $this->model::get();
    }
    /**
     * Find an entity by id
     *
     * @param int $id
     * @param array $with
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findById($id, array $with = array())
    {
        $query = $this->make($with);

        return $query->findOrFail($id);
    }
    /**
     * update by id
     *
     * @param integer $id
     * @param array $data
     * @return void
     */
    public function updateById(int $id, array $data)
    {
        return $this->model::findOrFail($id)->update($data);
    }
    /**
     * delete by id
     *
     * @param integer $id
     * @return void
     */
    public function deleteById(int $id)
    {
        return $this->model::destroy($id);
    }

    /**
     * Make a new instance of the entity to query on
     *
     * @param array $with
     */
    public function make(array $with = array())
    {
        return $this->model->with($with);
    }

    /**
     * Find a single entity by key value
     *
     * @param string $key
     * @param string $value
     * @param array $with
     */
    public function getFirstBy($key, $value, array $with = array())
    {
        $this->make($with)->where($key, '=', $value)->first();
    }

    /**
     * Find many entities by key value
     *
     * @param string $key
     * @param string $value
     * @param array $with
     */
    public function getManyBy($key, $value, array $with = array())
    {
        $this->make($with)->where($key, '=', $value)->get();
    }
}
