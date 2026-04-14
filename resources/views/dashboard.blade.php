<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tableau de bord FILM LIB
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('watched-movies.index') }}" class="bg-white shadow rounded-lg p-6 hover:shadow-md">
                    <h3 class="font-bold text-lg mb-2">Mes films vus</h3>
                    <p class="text-gray-600">Ajouter et noter les films déjà vus.</p>
                </a>

                <a href="{{ route('recommendations.index') }}" class="bg-white shadow rounded-lg p-6 hover:shadow-md">
                    <h3 class="font-bold text-lg mb-2">Mes recommandations</h3>
                    <p class="text-gray-600">Voir les suggestions personnalisées.</p>
                </a>

                <a href="{{ route('favorites.index') }}" class="bg-white shadow rounded-lg p-6 hover:shadow-md">
                    <h3 class="font-bold text-lg mb-2">Mes favoris</h3>
                    <p class="text-gray-600">Retrouver les films sauvegardés.</p>
                </a>
                <a href="{{ route('search.index') }}" class="bg-white shadow rounded-lg p-6 hover:shadow-md">
                    <h3 class="font-bold text-lg mb-2">Explorer</h3>
                    <p class="text-gray-600">Voir les films et séries récupérés depuis TMDB.</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>