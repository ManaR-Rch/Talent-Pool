<?php

namespace App\Services;

use App\Mail\CandidatureStatusChanged;
use App\Repositories\Contracts\CandidatureRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CandidatureService
{
    protected $candidatureRepository;

    public function __construct(CandidatureRepositoryInterface $candidatureRepository)
    {
        $this->candidatureRepository = $candidatureRepository;
    }

    public function getAllCandidatures()
    {
        return $this->candidatureRepository->getAll();
    }

    public function getCandidatureById($id)
    {
        return $this->candidatureRepository->getById($id);
    }

    public function getCandidaturesByUser($userId = null)
    {
        $userId = $userId ?? Auth::id();
        return $this->candidatureRepository->getByUser($userId);
    }

    public function getCandidaturesByAnnonce($annonceId)
    {
        return $this->candidatureRepository->getByAnnonce($annonceId);
    }

    public function createCandidature(array $data, $cvFile, $lettreFile = null)
    {
        $data['user_id'] = Auth::id();
        
        // Stockage du CV
        $cvPath = $cvFile->store('cv', 'public');
        $data['cv_path'] = $cvPath;
        
        // Stockage de la lettre de motivation si fournie
        if ($lettreFile) {
            $lettrePath = $lettreFile->store('lettres', 'public');
            $data['lettre_path'] = $lettrePath;
        }
        
        return $this->candidatureRepository->create($data);
    }

    public function updateCandidatureStatus($id, $status)
    {
        $result = $this->candidatureRepository->updateStatus($id, $status);
        $candidature = $result['candidature'];
        $oldStatus = $result['old_status'];
        
        // Envoi d'un email au candidat pour l'informer du changement de statut
        if ($oldStatus !== $status) {
            Mail::to($candidature->user->email)
                ->send(new CandidatureStatusChanged($candidature));
        }
        
        return $candidature;
    }

    public function updateCandidatureNotes($id, $notes)
    {
        return $this->candidatureRepository->update($id, [
            'notes_recruteur' => $notes
        ]);
    }

    public function deleteCandidature($id)
    {
        $candidature = $this->candidatureRepository->getById($id);
        
        // Suppression des fichiers
        if ($candidature->cv_path) {
            Storage::disk('public')->delete($candidature->cv_path);
        }
        
        if ($candidature->lettre_path) {
            Storage::disk('public')->delete($candidature->lettre_path);
        }
        
        return $this->candidatureRepository->delete($id);
    }

    public function hasCandidatureForAnnonce($annonceId, $userId = null)
    {
        $userId = $userId ?? Auth::id();
        return $this->candidatureRepository->getByUserAndAnnonce($userId, $annonceId) !== null;
    }

    public function countCandidaturesByUser($userId = null)
    {
        $userId = $userId ?? Auth::id();
        return $this->candidatureRepository->countByUser($userId);
    }

    public function countCandidaturesByAnnonce($annonceId)
    {
        return $this->candidatureRepository->countByAnnonce($annonceId);
    }

    public function countCandidaturesByStatut($statut)
    {
        return $this->candidatureRepository->countByStatut($statut);
    }
}