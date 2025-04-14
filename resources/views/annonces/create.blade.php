@extends('layouts.app')

@section('title', 'Publier une annonce')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-semibold text-gray-900 mb-6">Publier une annonce</h1>
                
                <form action="{{ route('annonces.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-6">
                            <label for="titre" class="block text-sm font-medium text-gray-700">Titre de l'annonce *</label>
                            <div class="mt-1">
                                <input type="text" name="titre" id="titre" value="{{ old('titre') }}" required class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            @error('titre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="sm:col-span-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description *</label>
                            <div class="mt-1">
                                <textarea name="description" id="description" rows="5" required class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="sm:col-span-3">
                            <label for="lieu" class="block text-sm font-medium text-gray-700">Lieu *</label>
                            <div class="mt-1">
                                <input type="text" name="lieu" id="lieu" value="{{ old('lieu') }}" required class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            @error('lieu')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="sm:col-span-3">
                            <label for="type_contrat" class="block text-sm font-medium text-gray-700">Type de contrat *</label>
                            <div class="mt-1">
                                <select name="type_contrat" id="type_contrat" required class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="">Sélectionnez un type</option>
                                    <option value="CDI" {{ old('type_contrat') == 'CDI' ? 'selected' : '' }}>CDI</option>
                                    <option value="CDD" {{ old('type_contrat') == 'CDD' ? 'selected' : '' }}>CDD</option>
                                    <option value="Stage" {{ old('type_contrat') == 'Stage' ? 'selected' : '' }}>Stage</option>
                                    <option value="Alternance" {{ old('type_contrat') == 'Alternance' ? 'selected' : '' }}>Alternance</option>
                                    <option value="Freelance" {{ old('type_contrat') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                </select>
                            </div>
                            @error('type_contrat')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="sm:col-span-3">
                            <label for="salaire_min" class="block text-sm font-medium text-gray-700">Salaire minimum (€)</label>
                            <div class="mt-1">
                                <input type="number" name="salaire_min" id="salaire_min" value="{{ old('salaire_min') }}" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            @error('salaire_min')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="sm:col-span-3">
                            <label for="salaire_max" class="block text-sm font-medium text-gray-700">Salaire maximum (€)</label>
                            <div class="mt-1">
                                <input type="number" name="salaire_max" id="salaire_max" value="{{ old('salaire_max') }}" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            @error('salaire_max')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="sm:col-span-6">
                            <label for="competences_requises" class="block text-sm font-medium text-gray-700">Compétences requises *</label>
                            <div class="mt-1">
                                <input type="text" name="competences_requises" id="competences_requises" value="{{ old('competences_requises') }}" required placeholder="PHP, Laravel, MySQL, etc. (séparées par des virgules)" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            @error('competences_requises')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="sm:col-span-3">
                            <label for="date_limite" class="block text-sm font-medium text-gray-700">Date limite de candidature</label>
                            <div class="mt-1">
                                <input type="date" name="date_limite" id="date_limite" value="{{ old('date_limite') }}" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            @error('date_limite')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="sm:col-span-3">
                            <label for="active" class="block text-sm font-medium text-gray-700">Statut</label>
                            <div class="mt-1">
                                <select name="active" id="active" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="1" {{ old('active', '1') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            @error('active')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('annonces.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Annuler
                        </a>
                        <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Publier l'annonce
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection