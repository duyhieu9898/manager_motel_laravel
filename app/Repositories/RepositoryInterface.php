<?php

namespace App\Repositories;

/**
 * Interface BaseRepositoryInterface
 *
 * @package App\Repositories
 */
interface RepositoryInterface
{
    public function create(array $data);
    public function get();
    public function findById(int $id);
    public function deleteById(int $id);
    public function updateById(int $id, array $data);
}
