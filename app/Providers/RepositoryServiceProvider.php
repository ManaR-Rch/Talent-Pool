<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\AnnonceRepositoryInterface;
use App\Repositories\Contracts\CandidatureRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\AnnonceRepository;
use App\Repositories\CandidatureRepository;
use App\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            AnnonceRepositoryInterface::class,
            AnnonceRepository::class
        );

        $this->app->bind(
            CandidatureRepositoryInterface::class,
            CandidatureRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }

    public function boot()
    {
        //
    }
}