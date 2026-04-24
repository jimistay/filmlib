<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        Saisissez le code généré par Microsoft Authenticator.
    </div>

    @if ($errors->any())
        <div class="mb-4 text-sm text-red-600">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ url('/two-factor-challenge') }}">
        @csrf

        <div class="mt-4">
            <x-input-label for="code" value="Code d'authentification" />
            <x-text-input
                id="code"
                class="block mt-1 w-full"
                type="text"
                name="code"
                inputmode="numeric"
                autocomplete="one-time-code"
                autofocus
            />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                Valider
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 border-t pt-6">
        <p class="mb-3 text-sm text-gray-600">
            Si vous n'avez plus accès à l'application, utilisez un code de secours.
        </p>

        <form method="POST" action="{{ url('/two-factor-challenge') }}">
            @csrf

            <div>
                <x-input-label for="recovery_code" value="Code de secours" />
                <x-text-input
                    id="recovery_code"
                    class="block mt-1 w-full"
                    type="text"
                    name="recovery_code"
                    autocomplete="one-time-code"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-secondary-button>
                    Utiliser le code de secours
                </x-secondary-button>
            </div>
        </form>
    </div>
</x-guest-layout>