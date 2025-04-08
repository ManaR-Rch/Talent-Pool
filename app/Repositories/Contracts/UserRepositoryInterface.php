<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function getByRole($role);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function countByRole($role);
}