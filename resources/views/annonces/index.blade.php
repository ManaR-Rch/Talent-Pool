@extends('layouts.app')

@section('title', 'Annonces')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900">Annonces</h1>
                    
                    @can('create', App\Models\Annonce::class)
                        <a href="{{ route('annonces.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Publier une annonce
                        </a>
                    @endcan
                </div>
                
                <div class="mb-6">
                    <form action="{{ route('annonces.index') }}" method="GET" class="flex gap-2">
                        <div class="flex-1">
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Rechercher par titre, description, lieu ou compétences" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Rechercher
                        </button>
                        @if($search)
                            <a href="{{ route('annonces.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Réinitialiser
                        </a>
                        @endif
                    </form>
                </div>
                
                @if($annonces->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($annonces as $annonce)
                            @include('components.annonce-card', ['annonce' => $annonce])
                        @endforeach
                    </div>
                    
                    <div class="mt-6">
                        {{ $annonces->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune annonce trouvée</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            @if($search)
                                Aucune annonce ne correspond à votre recherche.
                            @else
                                Aucune annonce n'est disponible pour le moment.
                            @endif
                        </p>
                        @can('create', App\Models\Annonce::class)
                            <div class="mt-6">
                                <a href="{{ route('annonces.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    Publier une annonce
                                </a>
                            </div>
                        @endcan
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection