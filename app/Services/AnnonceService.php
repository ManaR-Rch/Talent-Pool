<?php

namespace App\Services;

use App\Repositories\Contracts\AnnonceRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AnnonceService
{
    protected $annonceRepository;

    public function __construct(AnnonceRepositoryInterface $annonceRepository)
    {
        $this->annonceRepository = $annonceRepository;
    }

    public function getAllAnnonces($search = null)
    {
        return $this->annonceRepository->getAllActive($search);
    }

    public function getAnnonceById($id)
    {
        return $this->annonceRepository->getById($id);
    }

    public function getAnnoncesByUser($userId = null)
    {
        $userId = $userId ?? Auth::id();
        return $this->annonceRepository->getByUser($userId);
    }

    public function createAnnonce(array $data)
    {
        $data['user_id'] = Auth::id();
        return $this->annonceRepository->create($data);
    }

    public function updateAnnonce($id, array $data)
    {
        return $this->annonceRepository->update($id, $data);
    }

    public function deleteAnnonce($id)
    {
        return $this->annonceRepository->delete($id);
    }

    public function toggleAnnonceStatus($id)
    {
        $annonce = $this->annonceRepository->getById($id);
        return $this->annonceRepository->update($id, [
            'active' => !$annonce->active
        ]);
    }

    public function countAnnoncesByUser($userId = null)
    {
        $userId = $userId ?? Auth::id();
        return $this->annonceRepository->countByUser($userId);
    }
}