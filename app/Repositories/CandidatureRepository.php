<?php

namespace App\Repositories;

use App\Models\Candidature;
use App\Repositories\Contracts\CandidatureRepositoryInterface;

class CandidatureRepository implements CandidatureRepositoryInterface
{
    protected $model;

    public function __construct(Candidature $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->with(['user', 'annonce'])->latest()->paginate(10);
    }

    public function getById($id)
    {
        return $this->model->with(['user', 'annonce'])->findOrFail($id);
    }

    public function getByUser($userId)
    {
        return $this->model->where('user_id', $userId)
            ->with(['annonce'])
            ->latest()
            ->paginate(10);
    }

    public function getByAnnonce($annonceId)
    {
        return $this->model->where('annonce_id', $annonceId)
            ->with(['user'])
            ->latest()
            ->paginate(10);
    }

    public function getByUserAndAnnonce($userId, $annonceId)
    {
        return $this->model->where('user_id', $userId)
            ->where('annonce_id', $annonceId)
            ->first();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $candidature = $this->getById($id);
        $candidature->update($data);
        return $candidature;
    }

    public function updateStatus($id, $status)
    {
        $candidature = $this->getById($id);
        $oldStatus = $candidature->statut;
        $candidature->statut = $status;
        $candidature->save();
        
        return [
            'candidature' => $candidature,
            'old_status' => $oldStatus
        ];
    }

    public function delete($id)
    {
        $candidature = $this->getById($id);
        return $candidature->delete();
    }

    public function countByUser($userId)
    {
        return $this->model->where('user_id', $userId)->count();
    }

    public function countByAnnonce($annonceId)
    {
        return $this->model->where('annonce_id', $annonceId)->count();
    }

    public function countByStatut($statut)
    {
        return $this->model->where('statut', $statut)->count();
    }
}