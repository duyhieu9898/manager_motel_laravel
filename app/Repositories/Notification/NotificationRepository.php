<?php

namespace App\Repositories\Notification;

use App\Notification;
use App\Repositories\BaseRepository;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{
    /**
     * @var Notification
     */
    protected $model;

    /**
     * NotificationRepository constructor.
     *
     * @param Notification $model
     */
    public function __construct(Notification $model)
    {
        parent::__construct($model);
    }

    public function getByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->get();
    }
}
