<?php

namespace App\Repositories\Province;

use App\Province;
use App\Repositories\BaseRepository;

class ProvinceRepository extends BaseRepository implements ProvinceRepositoryInterface
{
    /**
     * @var Province
     */
    protected $model;

    /**
     * ProvinceRepository constructor.
     *
     * @param Province $model
     */
    public function __construct(Province $model)
    {
        parent::__construct($model);
    }
    public function findByName($name)
    {
        return $this->model->where('name', 'like', '%' . $name . '%')->first();
    }
}
