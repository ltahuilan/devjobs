<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Olvidaste tu password? Ingresa tu dirección de email, enviaremos un enlace para restablecer tu contraseña.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" novalidate>
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between m-4">
            <x-link :href="route('login')">
                Iniciar Sesión
            </x-link>
            <x-link :href="route('register')">
                Crear una cuenta
            </x-link>
        </div>
        <x-primary-button class="w-full justify-center">
            Enviar link
        </x-primary-button>
    </form>
</x-guest-layout>
