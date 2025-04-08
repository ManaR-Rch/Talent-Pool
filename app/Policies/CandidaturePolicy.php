<?php

namespace App\Policies;

use App\Models\Candidature;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CandidaturePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // Tout le monde peut voir la liste des candidatures
    }

    public function view(User $user, Candidature $candidature)
    {
        // Le candidat peut voir sa propre candidature
        // Le recruteur peut voir les candidatures pour ses annonces
        return $user->id === $candidature->user_id || 
               $user->id === $candidature->annonce->user_id || 
               $user->isAdmin();
    }

    public function create(User $user)
    {
        return $user->isCandidat() || $user->isAdmin();
    }

    public function update(User $user, Candidature $candidature)
    {
        // Seul le candidat peut mettre à jour sa candidature
        return $user->id === $candidature->user_id || $user->isAdmin();
    }

    public function delete(User $user, Candidature $candidature)
    {
        // Le candidat peut supprimer sa candidature
        return $user->id === $candidature->user_id || $user->isAdmin();
    }

    public function updateStatus(User $user, Candidature $candidature)
    {
        // Seul le recruteur de l'annonce peut changer le statut
        return $user->id === $candidature->annonce->user_id || $user->isAdmin();
    }
}