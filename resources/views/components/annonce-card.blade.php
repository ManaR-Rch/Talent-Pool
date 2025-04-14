<div class="bg-white shadow overflow-hidden sm:rounded-lg hover:shadow-md transition-shadow duration-300">
    <div class="px-4 py-5 sm:px-6 flex justify-between items-start">
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ $annonce->titre }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                {{ $annonce->lieu }} - {{ $annonce->type_contrat }}
            </p>
        </div>
        <div>
            @if($annonce->active)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    Active
                </span>
            @else
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    Inactive
                </span>
            @endif
        </div>
    </div>
    <div class="border-t border-gray-200">
        <div class="px-4 py-5 sm:p-6">
            <p class="text-sm text-gray-500 line-clamp-3">
                {{ Str::limit($annonce->description, 150) }}
            </p>
            
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach(explode(',', $annonce->competences_requises) as $competence)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ trim($competence) }}
                    </span>
                @endforeach
            </div>
            
            <div class="mt-4 flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    <span>Publiée par {{ $annonce->user->name }}</span>
                    <span class="mx-1">•</span>
                    <span>{{ $annonce->created_at->diffForHumans() }}</span>
                </div>
                
                <a href="{{ route('annonces.show', $annonce->id) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Voir l'annonce
                </a>
            </div>
        </div>
    </div>
</div>