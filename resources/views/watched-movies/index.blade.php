<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mes films vus
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 rounded bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6">
                <a href="{{ route('watched-movies.create') }}"
                   class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                    Ajouter un film
                </a>
            </div>

            <div class="bg-white shadow sm:rounded-lg p-6">
                @forelse ($movies as $movie)
                    <div class="border-b py-4 flex items-center justify-between">
                        <div>
                            <h3 class="font-bold">{{ $movie->title }}</h3>
                            <p class="text-sm text-gray-600">Note : {{ $movie->rating }}/5</p>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('watched-movies.edit', $movie) }}"
                               class="rounded bg-yellow-500 px-3 py-1 text-white">
                                Modifier
                            </a>

                            <form action="{{ route('watched-movies.destroy', $movie) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="rounded bg-red-600 px-3 py-1 text-white">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>Aucun film ajouté pour le moment.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>