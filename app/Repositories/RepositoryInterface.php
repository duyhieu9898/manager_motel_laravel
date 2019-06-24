<?php

namespace App\Repositories;

/**
 * Interface BaseRepositoryInterface
 *
 * @package App\Repositories
 */
interface RepositoryInterface
{
    public function getAll();
    public function findById(int $id);
}
