<?php

namespace App\Repositories\Address;

use App\Address;
use App\Repositories\BaseRepository;

class AddressRepository extends BaseRepository implements AddressRepositoryInterface
{
    /**
     * @var Address
     */
    protected $model;

    /**
     * AddressRepository constructor.
     *
     * @param Address $model
     */
    public function __construct(Address $model)
    {
        parent::__construct($model);
    }
}
