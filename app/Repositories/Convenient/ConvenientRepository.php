<?php

namespace App\Repositories\Convenience;

use App\Convenience;
use App\Repositories\BaseRepository;

class ConvenienceRepository extends BaseRepository implements ConvenienceRepositoryInterface
{
    /**
     * @var Convenience
     */
    protected $model;

    /**
     * ConvenienceRepository constructor.
     *
     * @param Convenience $model
     */
    public function __construct(Convenience $model)
    {
        parent::__construct($model);
    }
}
