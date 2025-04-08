<?php

namespace App\Providers;

use App\Models\Annonce;
use App\Models\Candidature;
use App\Policies\AnnoncePolicy;
use App\Policies\CandidaturePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Annonce::class => AnnoncePolicy::class,
        Candidature::class => CandidaturePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Définition des Gates pour les rôles
        Gate::define('access-recruteur', function ($user) {
            return $user->isRecruteur() || $user->isAdmin();
        });

        Gate::define('access-candidat', function ($user) {
            return $user->isCandidat() || $user->isAdmin();
        });

        Gate::define('access-admin', function ($user) {
            return $user->isAdmin();
        });
    }
}