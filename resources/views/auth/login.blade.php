<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Demo Banner -->
    <div class="mb-6 p-4 bg-gradient-to-r from-amber-50 to-yellow-50 border border-amber-200 rounded-xl">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-semibold text-amber-800">🎓 Mode Démonstration</h3>
                <p class="mt-1 text-xs text-amber-700">
                    Ce site est une démo de mon portfolio. Utilisez le bouton ci-dessous pour explorer l'application.
                </p>
            </div>
        </div>
    </div>

    <!-- Quick Demo Login Button -->
    <form method="POST" action="{{ route('login') }}" class="mb-6">
        @csrf
        <input type="hidden" name="email" value="salma.elyamani@etu.univ.ma">
        <input type="hidden" name="password" value="password123">
        <button type="submit" class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl shadow-md hover:from-blue-700 hover:to-indigo-700 transition-all duration-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            Accès Rapide (Compte Démo)
        </button>
    </form>

    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-slate-200"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-3 bg-white text-slate-500">ou connectez-vous manuellement</span>
        </div>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="w-full justify-center">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Demo Credentials Info -->
    <div class="mt-6 p-4 bg-slate-50 border border-slate-200 rounded-xl">
        <h4 class="text-xs font-semibold text-slate-600 uppercase tracking-wide mb-2">Identifiants de test</h4>
        <div class="space-y-2 text-xs text-slate-600">
            <div class="flex justify-between items-center p-2 bg-white rounded-lg border border-slate-100">
                <span class="font-medium">Étudiant</span>
                <code class="text-blue-600 bg-blue-50 px-2 py-0.5 rounded">salma.elyamani@etu.univ.ma</code>
            </div>
            <div class="flex justify-between items-center p-2 bg-white rounded-lg border border-slate-100">
                <span class="font-medium">Mot de passe</span>
                <code class="text-blue-600 bg-blue-50 px-2 py-0.5 rounded">password123</code>
            </div>
        </div>
    </div>
</x-guest-layout>
