@extends('layouts.app')

@section('title', 'Postuler à ' . $annonce->titre)

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-semibold text-gray-900 mb-2">Postuler à l'annonce</h1>
                <h2 class="text-xl text-gray-700 mb-6">{{ $annonce->titre }}</h2>
                
                <form action="{{ route('candidatures.store', $annonce->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-6">
                            <label for="message" class="block text-sm font-medium text-gray-700">Message de motivation *</label>
                            <div class="mt-1">
                                <textarea name="message" id="message" rows="5" required class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('message') }}</textarea>
                            </div>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="sm:col-span-6">
                            <label for="cv" class="block text-sm font-medium text-gray-700">CV (PDF) *</label>
                            <div class="mt-1">
                                <input type="file" name="cv" id="cv" accept=".pdf" required class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Format PDF uniquement, taille maximale 2 Mo</p>
                            @error('cv')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="sm:col-span-6">
                            <label for="lettre" class="block text-sm font-medium text-gray-700">Lettre de motivation (PDF)</label>
                            <div class="mt-1">
                                <input type="file" name="lettre" id="lettre" accept=".pdf" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Format PDF uniquement, taille maximale 2 Mo</p>
                            @error('lettre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('annonces.show', $annonce->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Annuler
                        </a>
                        <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Envoyer ma candidature
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection