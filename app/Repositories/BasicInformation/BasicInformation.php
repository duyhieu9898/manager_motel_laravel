<?php

namespace App\Repositories\BasicInformation;

use App\BasicInformation;
use App\Repositories\BaseRepository;

class BasicInformationRepository extends BaseRepository implements BasicInformationRepositoryInterface
{
    /**
     * @var BasicInformation
     */
    protected $model;

    /**
     * BasicInformationRepository constructor.
     *
     * @param BasicInformation $model
     */
    public function __construct(BasicInformation $model)
    {
        parent::__construct($model);
    }
}
