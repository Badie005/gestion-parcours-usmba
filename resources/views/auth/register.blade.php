<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Nom -->
            <div>
                <x-input-label for="nom_fr" :value="__('Nom (Fr)')" />
                <x-text-input id="nom_fr" class="block mt-1 w-full" type="text" name="nom_fr" :value="old('nom_fr')" required autofocus autocomplete="family-name" />
                <x-input-error :messages="$errors->get('nom_fr')" class="mt-2" />
            </div>

            <!-- Prénom -->
            <div>
                <x-input-label for="prenom_fr" :value="__('Prénom (Fr)')" />
                <x-text-input id="prenom_fr" class="block mt-1 w-full" type="text" name="prenom_fr" :value="old('prenom_fr')" required autocomplete="given-name" />
                <x-input-error :messages="$errors->get('prenom_fr')" class="mt-2" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email_academique" :value="__('Email académique')" />
            <x-text-input id="email_academique" class="block mt-1 w-full" type="email" name="email_academique" :value="old('email_academique')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email_academique')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Mot de passe')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirmation du mot de passe')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <!-- Date de naissance -->
        <div class="mt-4">
            <x-input-label for="date_naissance" :value="__('Date de naissance')" />
            <x-text-input id="date_naissance" class="block mt-1 w-full" type="text" name="date_naissance" :value="old('date_naissance')" required />
            <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
        </div>

        <!-- Téléphone -->
        <div class="mt-4">
            <x-input-label for="telephone" :value="__('Téléphone')" />
            <x-text-input id="telephone" class="block mt-1 w-full" type="tel" name="telephone" :value="old('telephone')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>

        <!-- Filière -->
        <div class="mt-4">
            <x-input-label for="code_deug" :value="__('Filière')" />
            <select id="code_deug" name="code_deug" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">Sélectionnez une filière</option>
                @foreach($filieres as $filiere)
                    <option value="{{ $filiere->code_deug }}" {{ old('code_deug') == $filiere->code_deug ? 'selected' : '' }}>
                        {{ $filiere->deug_intitule_fr }} {{ $filiere->choix_parcour_autorise ? '' : '(Parcours par défaut)' }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('code_deug')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
