<?php

namespace App\Repositories;

use App\Models\Annonce;

class AnnonceRepository
{
    protected $model;

    public function __construct(Annonce $model)
    {
        $this->model = $model;
    }

    public function getAll($search = null)
    {
        return $this->model->search($search)->with('user')->latest()->paginate(10);
    }

    public function getAllActive($search = null)
    {
        return $this->model->active()->search($search)->with('user')->latest()->paginate(10);
    }

    public function getById($id)
    {
        return $this->model->with(['user', 'candidatures'])->findOrFail($id);
    }

    public function getByUser($userId)
    {
        return $this->model->where('user_id', $userId)->latest()->paginate(10);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $annonce = $this->getById($id);
        $annonce->update($data);
        return $annonce;
    }

    public function delete($id)
    {
        $annonce = $this->getById($id);
        return $annonce->delete();
    }

    public function countByUser($userId)
    {
        return $this->model->where('user_id', $userId)->count();
    }
}