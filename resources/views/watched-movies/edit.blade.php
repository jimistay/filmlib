<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier la note
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('watched-movies.update', $watchedMovie) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium">Titre</label>
                        <input type="text" value="{{ $watchedMovie->title }}" class="w-full rounded border-gray-300 bg-gray-100" disabled>
                    </div>

                    <div>
                        <label class="block font-medium">Note</label>
                        <select name="rating" class="w-full rounded border-gray-300" required>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ $watchedMovie->rating == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium">Date de visionnage</label>
                        <input type="datetime-local"
                               name="watched_at"
                               value="{{ $watchedMovie->watched_at ? $watchedMovie->watched_at->format('Y-m-d\TH:i') : '' }}"
                               class="w-full rounded border-gray-300">
                    </div>

                    <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                        Mettre à jour
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>