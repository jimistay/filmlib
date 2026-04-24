<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Sécurité du compte
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <h3 class="text-lg font-semibold mb-4">
                    Double authentification
                </h3>

                @if (session('status') == 'two-factor-authentication-enabled')
                    <div class="mb-4 text-green-600">
                        Double authentification activée. Scanne le QR code.
                    </div>
                @endif

                @if (session('status') == 'two-factor-authentication-confirmed')
                    <div class="mb-4 text-green-600">
                        Double authentification confirmée.
                    </div>
                @endif

                @if (is_null(auth()->user()->two_factor_secret))
                    <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
                        @csrf
                        <button class="px-4 py-2 bg-blue-600 text-white rounded">
                            Activer Microsoft Authenticator
                        </button>
                    </form>
                @else
                    <div class="mb-6">
                        <p class="mb-2">Scanne ce QR code :</p>

                        <div class="bg-white p-4 inline-block border rounded">
                            {!! auth()->user()->twoFactorQrCodeSvg() !!}
                        </div>
                    </div>

                    @if (is_null(auth()->user()->two_factor_confirmed_at))
                        <form method="POST" action="{{ url('/user/confirmed-two-factor-authentication') }}">
                            @csrf

                            <input
                                type="text"
                                name="code"
                                placeholder="Code à 6 chiffres"
                                class="border p-2 w-full rounded"
                            >

                            @error('code')
                                <div class="text-red-600 mt-2">{{ $message }}</div>
                            @enderror

                            <button class="mt-4 px-4 py-2 bg-green-600 text-white rounded">
                                Confirmer
                            </button>
                        </form>
                    @else
                        <div class="mt-6">
                            <h4 class="font-semibold">Codes de secours :</h4>

                            <div class="bg-gray-100 p-4 mt-2 rounded">
                                @foreach (auth()->user()->recoveryCodes() as $code)
                                    <div>{{ $code }}</div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-6 flex gap-3">
                            <form method="POST" action="{{ url('/user/two-factor-recovery-codes') }}">
                                @csrf
                                <button class="px-4 py-2 bg-gray-600 text-white rounded">
                                    Régénérer
                                </button>
                            </form>

                            <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
                                @csrf
                                @method('DELETE')

                                <button class="px-4 py-2 bg-red-600 text-white rounded">
                                    Désactiver
                                </button>
                            </form>
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
</x-app-layout>