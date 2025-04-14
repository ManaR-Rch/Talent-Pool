@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="relative bg-primary-600">
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80" alt="People working on laptops">
        <div class="absolute inset-0 bg-primary-700 mix-blend-multiply"></div>
    </div>
    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">TalentPool</h1>
        <p class="mt-6 text-xl text-indigo-100 max-w-3xl">La plateforme qui connecte les talents aux meilleures opportunités professionnelles.</p>
        <div class="mt-10 flex flex-col sm:flex-row gap-4">
            <a href="{{ route('annonces.index') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-primary-700 bg-white hover:bg-indigo-50">
                Voir les annonces
            </a>
            @guest
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-500 hover:bg-primary-600">
                    Créer un compte
                </a>
            @endguest
        </div>
    </div>
</div>

<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <h2 class="text-base text-primary-600 font-semibold tracking-wide uppercase">Notre plateforme</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Une meilleure façon de recruter
            </p>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                TalentPool simplifie le processus de recrutement pour les entreprises et les candidats.
            </p>
        </div>

        <div class="mt-10">
            <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                <div class="relative">
                    <dt>
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Pour les recruteurs</p>
                    </dt>
                    <dd class="mt-2 ml-16 text-base text-gray-500">
                        Publiez vos offres d'emploi, gérez les candidatures et trouvez les meilleurs talents pour votre entreprise.
                    </dd>
                </div>

                <div class="relative">
                    <dt>
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Pour les candidats</p>
                    </dt>
                    <dd class="mt-2 ml-16 text-base text-gray-500">
                        Trouvez les meilleures opportunités d'emploi, postulez en quelques clics et suivez vos candidatures.
                    </dd>
                </div>

                <div class="relative">
                    <dt>
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Processus simplifié</p>
                    </dt>
                    <dd class="mt-2 ml-16 text-base text-gray-500">
                        Un processus de recrutement fluide et transparent, du dépôt de l'offre à l'embauche.
                    </dd>
                </div>

                <div class="relative">
                    <dt>
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Rapide et efficace</p>
                    </dt>
                    <dd class="mt-2 ml-16 text-base text-gray-500">
                        Gagnez du temps dans votre processus de recrutement grâce à nos outils optimisés.
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>

<div class="bg-gray-50 pt-12 sm:pt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Rejoignez des milliers d'entreprises et de candidats
            </h2>
            <p class="mt-3 text-xl text-gray-500 sm:mt-4">
                Notre plateforme connecte les meilleurs talents aux meilleures opportunités.
            </p>
        </div>
    </div>
    <div class="mt-10 pb-12 bg-white sm:pb-16">
        <div class="relative">
            <div class="absolute inset-0 h-1/2 bg-gray-50"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto">
                    <dl class="rounded-lg bg-white shadow-lg sm:grid sm:grid-cols-3">
                        <div class="flex flex-col border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                            <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                Annonces
                            </dt>
                            <dd class="order-1 text-5xl font-extrabold text-primary-600">
                                {{ App\Models\Annonce::count() }}
                            </dd>
                        </div>
                        <div class="flex flex-col border-t border-b border-gray-100 p-6 text-center sm:border-0 sm:border-l sm:border-r">
                            <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                Candidats
                            </dt>
                            <dd class="order-1 text-5xl font-extrabold text-primary-600">
                                {{ App\Models\User::where('role', 'candidat')->count() }}
                            </dd>
                        </div>
                        <div class="flex flex-col border-t border-gray-100 p-6 text-center sm:border-0 sm:border-l">
                            <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                Recruteurs
                            </dt>
                            <dd class="order-1 text-5xl font-extrabold text-primary-600">
                                {{ App\Models\User::where('role', 'recruteur')->count() }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection