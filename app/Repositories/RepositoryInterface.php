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
    public function findById($id, array $with = array());
    public function deleteById(int $id);
    public function updateById(int $id, array $data);
    public function make(array $with);
    public function getFirstBy($key, $value, array $with);
    public function getManyBy($key, $value, array $with);
}
