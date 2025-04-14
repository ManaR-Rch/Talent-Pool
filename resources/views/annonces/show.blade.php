@extends('layouts.app')

@section('title', $annonce->titre)

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900">{{ $annonce->titre }}</h1>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <span>{{ $annonce->lieu }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $annonce->type_contrat }}</span>
                            <span class="mx-2">•</span>
                            <span>Publiée {{ $annonce->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        @if($annonce->active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Active
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Inactive
                            </span>
                        @endif
                        
                        @can('update', $annonce)
                            <div class="flex space-x-2">
                                <a href="{{ route('annonces.edit', $annonce->id) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    Modifier
                                </a>
                                
                                <form action="{{ route('annonces.toggle-status', $annonce->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        {{ $annonce->active ? 'Désactiver' : 'Activer' }}
                                    </button>
                                </form>
                                
                                <form action="{{ route('annonces.destroy', $annonce->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        @endcan
                    </div>
                </div>
                
                <div class="mt-6">
                    <div class="prose max-w-none">
                        <h3 class="text-lg font-medium text-gray-900">Description</h3>
                        <div class="mt-2 text-gray-600 whitespace-pre-line">
                            {{ $annonce->description }}
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900">Compétences requises</h3>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach(explode(',', $annonce->competences_requises) as $competence)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ trim($competence) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Informations complémentaires</h3>
                            <div class="mt-2 text-sm text-gray-500">
                                <div class="flex items-center">
                                    <span class="font-medium">Entreprise:</span>
                                    <span class="ml-2">{{ $annonce->user->entreprise ?? 'Non spécifié' }}</span>
                                </div>
                                <div class="flex items-center mt-1">
                                    <span class="font-medium">Salaire:</span>
                                    <span class="ml-2">
                                        @if($annonce->salaire_min && $annonce->salaire_max)
                                            {{ number_format($annonce->salaire_min, 0, ',', ' ') }} € - {{ number_format($annonce->salaire_max, 0, ',', ' ') }} €
                                        @elseif($annonce->salaire_min)
                                            À partir de {{ number_format($annonce->salaire_min, 0, ',', ' ') }} €
                                        @elseif($annonce->salaire_max)
                                            Jusqu'à {{ number_format($annonce->salaire_max, 0, ',', ' ') }} €
                                        @else
                                            Non spécifié
                                        @endif
                                    </span>
                                </div>
                                <div class="flex items-center mt-1">
                                    <span class="font-medium">Date limite:</span>
                                    <span class="ml-2">
                                        {{ $annonce->date_limite ? $annonce->date_limite->format('d/m/Y') : 'Non spécifiée' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Contact</h3>
                            <div class="mt-2 text-sm text-gray-500">
                                <div class="flex items-center">
                                    <span class="font-medium">Recruteur:</span>
                                    <span class="ml-2">{{ $annonce->user->name }}</span>
                                </div>
                                <div class="flex items-center mt-1">
                                    <span class="font-medium">Poste:</span>
                                    <span class="ml-2">{{ $annonce->user->poste ?? 'Non spécifié' }}</span>
                                </div>
                                <div class="flex items-center mt-1">
                                    <span class="font-medium">Email:</span>
                                    <span class="ml-2">{{ $annonce->user->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 flex justify-between items-center">
                        <a href="{{ route('annonces.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Retour aux annonces
                        </a>
                        
                        @auth
                            @if(Auth::user()->isCandidat() && $annonce->active)
                                @if($hasCandidature)
                                    <span class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600">
                                        Vous avez déjà postulé
                                    </span>
                                @else
                                    <a href="{{ route('candidatures.create', $annonce->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        Postuler
                                    </a>
                                @endif
                            @endif
                            
                            @can('viewCandidatures', $annonce)
                                <a href="{{ route('annonces.candidatures', $annonce->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    Voir les candidatures ({{ $annonce->candidatures->count() }})
                                </a>
                            @endcan
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                Connectez-vous pour postuler
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection