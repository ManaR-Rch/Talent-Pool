@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-md mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-semibold text-gray-900 mb-6">{{ __('Inscription') }}</h1>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nom -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nom') }} *</label>
                        <input id="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50 @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Adresse email') }} *</label>
                        <input id="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rôle -->
                    <div class="mb-4">
                        <label for="role" class="block text-sm font-medium text-gray-700">{{ __('Je suis') }} *</label>
                        <div class="mt-1">
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center">
                                    <input id="role-candidat" name="role" type="radio" value="candidat" class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300" {{ old('role') == 'candidat' ? 'checked' : '' }} required>
                                    <label for="role-candidat" class="ml-2 block text-sm text-gray-700">
                                        {{ __('Un candidat') }}
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input id="role-recruteur" name="role" type="radio" value="recruteur" class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300" {{ old('role') == 'recruteur' ? 'checked' : '' }}>
                                    <label for="role-recruteur" class="ml-2 block text-sm text-gray-700">
                                        {{ __('Un recruteur') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('role')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Champs spécifiques aux recruteurs (conditionnels) -->
                    <div id="recruteur-fields" class="mb-4 {{ old('role') == 'recruteur' ? '' : 'hidden' }}">
                        <div class="mb-4">
                            <label for="entreprise" class="block text-sm font-medium text-gray-700">{{ __('Entreprise') }} *</label>
                            <input id="entreprise" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50 @error('entreprise') border-red-500 @enderror" name="entreprise" value="{{ old('entreprise') }}">
                            @error('entreprise')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="poste" class="block text-sm font-medium text-gray-700">{{ __('Poste occupé') }}</label>
                            <input id="poste" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50 @error('poste') border-red-500 @enderror" name="poste" value="{{ old('poste') }}">
                            @error('poste')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Mot de passe') }} *</label>
                        <input id="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50 @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirmation du mot de passe -->
                    <div class="mb-6">
                        <label for="password-confirm" class="block text-sm font-medium text-gray-700">{{ __('Confirmer le mot de passe') }} *</label>
                        <input id="password-confirm" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <a class="text-sm text-primary-600 hover:text-primary-500" href="{{ route('login') }}">
                            {{ __('Déjà inscrit ?') }}
                        </a>

                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:border-primary-800 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
                            {{ __('S\'inscrire') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Script pour afficher/masquer les champs spécifiques aux recruteurs
    document.addEventListener('DOMContentLoaded', function() {
        const roleCandidat = document.getElementById('role-candidat');
        const roleRecruteur = document.getElementById('role-recruteur');
        const recruteurFields = document.getElementById('recruteur-fields');
        
        function toggleRecruteurFields() {
            if (roleRecruteur.checked) {
                recruteurFields.classList.remove('hidden');
                document.getElementById('entreprise').setAttribute('required', 'required');
            } else {
                recruteurFields.classList.add('hidden');
                document.getElementById('entreprise').removeAttribute('required');
            }
        }
        
        roleCandidat.addEventListener('change', toggleRecruteurFields);
        roleRecruteur.addEventListener('change', toggleRecruteurFields);
        
        // Initialiser l'état au chargement de la page
        toggleRecruteurFields();
    });
</script>
@endpush
@endsection