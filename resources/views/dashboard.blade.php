<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>




                <div class="p-6 text-gray-900 dark:text-gray-100">
        @if (auth()->user()->two_factor_secret)
        <p>{{ __('Two-factor authentication is enabled on your account.') }}</p>

        <form method="POST" action="{{ url('user/two-factor-authentication') }}">
            @csrf
            @method('DELETE')

            <x-danger-button class="ms-3">

                {{ __(' Disable 2FA 2FA') }}
            </x-danger-button>
        </form>

        @if (session('status') == 'two-factor-authentication-enabled')
            <div>
                <p>{{ __('Two-factor authentication is now enabled. Please scan the following QR code using your authenticator app.') }}</p>
                {!! auth()->user()->twoFactorQrCodeSvg() !!}
            </div>
        @endif

        <h3>Recovery Codes</h3>
        <ul>
            @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)
                <li>{{ $code }}</li>
            @endforeach
        </ul>
    @else
        <form method="POST" action="{{ url('user/two-factor-authentication') }}">
            @csrf


            <x-primary-button>
                {{ __('Enable 2FA') }}
            </x-primary-button>
        </form>
    @endif
            </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
