<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mes recommandations IA
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Messages --}}
            @if(session('success'))
                <div class="rounded bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="rounded bg-red-100 p-4 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            {{-- 🔥 BOUTON IMPORTANT --}}
            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('recommendations.generate') }}">
                    @csrf

                    <button type="submit"
                        class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-semibold">
                        Générer mes recommandations
                    </button>
                </form>
            </div>

            {{-- LISTE --}}
            @if($recommendations->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recommendations as $recommendation)
                        <div class="bg-white shadow rounded-lg p-4">

                            @if($recommendation->poster_url)
                                <img src="{{ $recommendation->poster_url }}"
                                     class="w-full h-80 object-cover rounded mb-4">
                            @endif

                            <div class="mb-2">
                                <span class="text-xs bg-gray-200 px-2 py-1 rounded">
                                    {{ $recommendation->media_type === 'movie' ? 'Film' : 'Série' }}
                                </span>
                            </div>

                            <h3 class="text-lg font-bold mb-2">
                                {{ $recommendation->title }}
                            </h3>

                            <p class="text-sm text-gray-700">
                                {{ $recommendation->reason }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white shadow rounded-lg p-6">
                    Aucune recommandation pour le moment.
                </div>
            @endif

        </div>
    </div>
</x-app-layout>