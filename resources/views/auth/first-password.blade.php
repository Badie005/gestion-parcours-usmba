<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Pour des raisons de sécurité, vous devez changer votre mot de passe par défaut avant de continuer.') }}
    </div>
    
    @if ($errors->any())
    <div class="mb-4">
        <div class="font-medium text-red-600">
            {{ __('Oups! Quelque chose s\'est mal passé.') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('password.first.update') }}">
        @csrf

        <!-- Current Password -->
        <div>
            <x-input-label for="current_password" :value="__('Mot de passe actuel')" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <!-- New Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Nouveau mot de passe')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="text-sm bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                {{ __('Confirmer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
