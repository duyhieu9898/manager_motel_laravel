<?php

namespace App\Repositories\Convenient;

use App\Convenient;
use App\Repositories\BaseRepository;

class ConvenientRepository extends BaseRepository implements ConvenientRepositoryInterface
{
    /**
     * @var Convenient
     */
    protected $model;

    /**
     * ConvenientRepository constructor.
     *
     * @param Convenient $model
     */
    public function __construct(Convenient $model)
    {
        parent::__construct($model);
    }
}
