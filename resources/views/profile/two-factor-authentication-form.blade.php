<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Double authentification
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Active Microsoft Authenticator pour sécuriser ton compte.
        </p>
    </header>

    @if (session('status') == 'two-factor-authentication-enabled')
        <div class="mt-4 text-sm text-green-600">
            La double authentification a été activée. Termine la configuration ci-dessous.
        </div>
    @endif

    @if (session('status') == 'two-factor-authentication-confirmed')
        <div class="mt-4 text-sm text-green-600">
            La double authentification est confirmée.
        </div>
    @endif

    <div class="mt-6">
        @if (is_null(auth()->user()->two_factor_secret))
            <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
                @csrf

                <x-primary-button>
                    Activer Microsoft Authenticator
                </x-primary-button>
            </form>
        @else
            <div class="mb-6">
                <p class="mb-3 text-sm text-gray-600">
                    Scanne ce QR code avec Microsoft Authenticator.
                </p>

                <div class="inline-block bg-white p-4 rounded">
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                </div>
            </div>

            @if (is_null(auth()->user()->two_factor_confirmed_at))
                <form method="POST" action="{{ url('/user/confirmed-two-factor-authentication') }}">
                    @csrf

                    <div>
                        <x-input-label for="code" value="Code de confirmation" />
                        <x-text-input id="code" name="code" type="text" class="block mt-1 w-full" inputmode="numeric" />
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-primary-button>
                            Confirmer l'activation
                        </x-primary-button>
                    </div>
                </form>
            @else
                <div class="mt-6">
                    <h3 class="text-md font-medium text-gray-900">
                        Codes de secours
                    </h3>

                    <div class="mt-3 rounded bg-gray-100 p-4 text-sm text-gray-700">
                        @foreach (auth()->user()->recoveryCodes() as $code)
                            <div>{{ $code }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="mt-6 flex gap-3">
                <form method="POST" action="{{ url('/user/two-factor-recovery-codes') }}">
                    @csrf

                    <x-secondary-button>
                        Régénérer les codes de secours
                    </x-secondary-button>
                </form>

                <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
                    @csrf
                    @method('DELETE')

                    <x-danger-button>
                        Désactiver la double authentification
                    </x-danger-button>
                </form>
            </div>
        @endif
    </div>
</section>