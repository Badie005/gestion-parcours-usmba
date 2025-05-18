<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informations Étudiant') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Complétez vos informations personnelles pour la génération de votre attestation de parcours.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.student.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Prénom -->
            <div>
                <x-input-label for="prenom" :value="__('Prénom')" />
                <x-text-input id="prenom" name="prenom" type="text" class="mt-1 block w-full" :value="old('prenom', $user->prenom)" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('prenom')" />
            </div>

            <!-- Nom -->
            <div>
                <x-input-label for="nom" :value="__('Nom')" />
                <x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full" :value="old('nom', $user->nom)" required />
                <x-input-error class="mt-2" :messages="$errors->get('nom')" />
            </div>

            <!-- Date de naissance -->
            <div>
                <x-input-label for="date_naissance" :value="__('Date de naissance')" />
                <x-text-input id="date_naissance" name="date_naissance" type="date" class="mt-1 block w-full" :value="old('date_naissance', $user->date_naissance?->format('Y-m-d'))" required />
                <x-input-error class="mt-2" :messages="$errors->get('date_naissance')" />
            </div>

            <!-- Téléphone -->
            <div>
                <x-input-label for="telephone" :value="__('Téléphone')" />
                <x-text-input id="telephone" name="telephone" type="tel" class="mt-1 block w-full" :value="old('telephone', $user->telephone)" required pattern="[0-9]{10}" />
                <x-input-error class="mt-2" :messages="$errors->get('telephone')" />
                <p class="text-xs text-gray-500 mt-1">Format: 0612345678</p>
            </div>
        </div>

        <!-- Adresse -->
        <div>
            <x-input-label for="adresse" :value="__('Adresse')" />
            <textarea id="adresse" name="adresse" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" required>{{ old('adresse', $user->adresse) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('adresse')" />
        </div>

        <!-- Filière (en lecture seule) -->
        <div>
            <x-input-label for="filiere" :value="__('Filière')" />
            <x-text-input id="filiere" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->filiere->nom_filiere" readonly disabled />
            <p class="text-xs text-gray-500 mt-1">La filière ne peut pas être modifiée. Si vous souhaitez changer de filière, veuillez contacter l'administration.</p>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                {{ __('Enregistrer les informations') }}
            </x-primary-button>

            @if (session('status') === 'student-info-updated')
                <x-notification type="success" message="Vos informations ont été mises à jour." />
            @endif
        </div>
    </form>
</section>
