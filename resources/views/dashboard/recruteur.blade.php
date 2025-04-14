@extends('layouts.app')

@section('title', 'Tableau de bord recruteur')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Tableau de bord recruteur</h1>
        
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total des annonces</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['total_annonces'] }}</dd>
                    </dl>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:px-6">
                    <div class="text-sm">
                        <a href="{{ route('annonces.create') }}" class="font-medium text-primary-600 hover:text-primary-500">Publier une nouvelle annonce</a>
                    </div>
                </div>
            </div>
            
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total des candidatures</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['total_candidatures'] }}</dd>
                    </dl>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:px-6">
                    <div class="text-sm">
                        <a href="#mes-annonces" class="font-medium text-primary-600 hover:text-primary-500">Voir les candidatures</a>
                    </div>
                </div>
            </div>
            
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Candidatures en attente</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['candidatures_par_statut']['en_attente'] }}</dd>
                    </dl>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:px-6">
                    <div class="text-sm">
                        <a href="#mes-annonces" class="font-medium text-primary-600 hover:text-primary-500">Traiter les candidatures</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-8">
            <h2 id="mes-annonces" class="text-xl font-semibold text-gray-900 mb-4">Mes annonces</h2>
            
            @if($annonces->count() > 0)
                <div class="bg-white shadow overflow-hidden sm:rounded-md">
                    <ul class="divide-y divide-gray-200">
                        @foreach($annonces as $annonce)
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <p class="text-sm font-medium text-primary-600 truncate">{{ $annonce->titre }}</p>
                                            <div class="ml-2 flex-shrink-0 flex">
                                                @if($annonce->active)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Active
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Inactive
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ $annonce->candidatures->count() }} candidature(s)
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mt-2 sm:flex sm:justify-between">
                                        <div class="sm:flex">
                                            <p class="flex items-center text-sm text-gray-500">
                                                {{ $annonce->lieu }} - {{ $annonce->type_contrat }}
                                            </p>
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                            <p>
                                                Publiée {{ $annonce->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-2 flex justify-end space-x-2">
                                        <a href="{{ route('annonces.show', $annonce->id) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                            Voir
                                        </a>
                                        <a href="{{ route('annonces.edit', $annonce->id) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                            Modifier
                                        </a>
                                        <a href="{{ route('annonces.candidatures', $annonce->id) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                            Candidatures ({{ $annonce->candidatures->count() }})
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="mt-4">
                    {{ $annonces->links() }}
                </div>
            @else
                <div class="bg-white shadow overflow-hidden sm:rounded-md p-6 text-center">
                    <p class="text-gray-500">Vous n'avez pas encore publié d'annonces.</p>
                    <div class="mt-4">
                        <a href="{{ route('annonces.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Publier une annonce
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

