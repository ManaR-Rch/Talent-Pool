<?php

namespace App\Repositories\Contracts;

interface AnnonceRepositoryInterface
{
    public function getAll($search = null);
    public function getAllActive($search = null);
    public function getById($id);
    public function getByUser($userId);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function countByUser($userId);
}