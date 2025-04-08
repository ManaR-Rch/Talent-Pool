<?php

namespace App\Policies;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnoncePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // Tout le monde peut voir la liste des annonces
    }

    public function view(User $user, Annonce $annonce)
    {
        return true; // Tout le monde peut voir une annonce
    }

    public function create(User $user)
    {
        return $user->isRecruteur() || $user->isAdmin();
    }

    public function update(User $user, Annonce $annonce)
    {
        return $user->id === $annonce->user_id || $user->isAdmin();
    }

    public function delete(User $user, Annonce $annonce)
    {
        return $user->id === $annonce->user_id || $user->isAdmin();
    }

    public function viewCandidatures(User $user, Annonce $annonce)
    {
        return $user->id === $annonce->user_id || $user->isAdmin();
    }
}