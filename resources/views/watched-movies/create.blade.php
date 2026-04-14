<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter un film vu
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('watched-movies.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block font-medium">TMDB ID</label>
                        <input type="number" name="tmdb_id" class="w-full rounded border-gray-300" required>
                    </div>

                    <div>
                        <label class="block font-medium">Titre</label>
                        <input type="text" name="title" class="w-full rounded border-gray-300" required>
                    </div>

                    <div>
                        <label class="block font-medium">URL de l'affiche</label>
                        <input type="url" name="poster_url" class="w-full rounded border-gray-300">
                    </div>

                    <div>
                        <label class="block font-medium">Note</label>
                        <select name="rating" class="w-full rounded border-gray-300" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium">Date de visionnage</label>
                        <input type="datetime-local" name="watched_at" class="w-full rounded border-gray-300">
                    </div>

                    <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                        Enregistrer
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>