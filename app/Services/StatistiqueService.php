<?php

namespace App\Services;

use App\Repositories\Contracts\AnnonceRepositoryInterface;
use App\Repositories\Contracts\CandidatureRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class StatistiqueService
{
    protected $annonceRepository;
    protected $candidatureRepository;
    protected $userRepository;

    public function __construct(
        AnnonceRepositoryInterface $annonceRepository,
        CandidatureRepositoryInterface $candidatureRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->annonceRepository = $annonceRepository;
        $this->candidatureRepository = $candidatureRepository;
        $this->userRepository = $userRepository;
    }

    public function getRecruteurStats($userId = null)
    {
        $userId = $userId ?? Auth::id();
        
        return [
            'total_annonces' => $this->annonceRepository->countByUser($userId),
            'total_candidatures' => 0, //  => $this->annonceRepository->countByUser($userId),
            'total_candidatures' => 0, // Initialisation
            'candidatures_par_statut' => [
                'en_attente' => 0,
                'en_cours' => 0,
                'acceptee' => 0,
                'refusee' => 0,
            ],
        ];
    }

    public function getGlobalStats()
    {
        return [
            'total_annonces' => $this->annonceRepository->getAll()->total(),
            'total_candidatures' => $this->candidatureRepository->getAll()->total(),
            'total_recruteurs' => $this->userRepository->countByRole('recruteur'),
            'total_candidats' => $this->userRepository->countByRole('candidat'),
            'candidatures_par_statut' => [
                'en_attente' => $this->candidatureRepository->countByStatut('en_attente'),
                'en_cours' => $this->candidatureRepository->countByStatut('en_cours'),
                'acceptee' => $this->candidatureRepository->countByStatut('acceptee'),
                'refusee' => $this->candidatureRepository->countByStatut('refusee'),
            ],
        ];
    }
}