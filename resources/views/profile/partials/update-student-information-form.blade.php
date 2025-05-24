<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informations Étudiant') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Complétez vos informations personnelles pour la génération de votre attestation de parcours.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.student.update') }}" class="mt-6 space-y-4">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Prénom -->
            <div>
                <label for="prenom" class="block text-sm font-medium text-gray-700">{{ __('Prénom') }}</label>
                <input id="prenom" name="prenom" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" value="{{ old('prenom', $user->prenom_fr) }}" required />
                @error('prenom')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nom -->
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">{{ __('Nom') }}</label>
                <input id="nom" name="nom" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" value="{{ old('nom', $user->nom_fr) }}" required />
                @error('nom')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date de naissance -->
            <div>
                <label for="date_naissance" class="block text-sm font-medium text-gray-700">{{ __('Date de naissance') }}</label>
                <input id="date_naissance" name="date_naissance" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" value="{{ old('date_naissance', $user->date_naissance?->format('Y-m-d')) }}" required />
                @error('date_naissance')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Téléphone -->
            <div>
                <label for="telephone" class="block text-sm font-medium text-gray-700">{{ __('Téléphone') }}</label>
                <input id="telephone" name="telephone" type="tel" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" value="{{ old('telephone', $user->telephone) }}" />
                @error('telephone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-1">Format: 0612345678</p>
            </div>
        </div>

        <!-- Adresse -->
        <div>
            <label for="adresse" class="block text-sm font-medium text-gray-700">{{ __('Adresse') }}</label>
            <textarea id="adresse" name="adresse" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('adresse', $user->adresse) }}</textarea>
            @error('adresse')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Filière (en lecture seule) -->
        <div>
            <label for="filiere" class="block text-sm font-medium text-gray-700">{{ __('Filière') }}</label>
            <input id="filiere" type="text" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 text-sm" value="{{ $user->filiere?->deug_intitule_fr ?? 'Non assignée' }}" readonly disabled />
            <p class="text-xs text-gray-500 mt-1">La filière ne peut pas être modifiée. Contactez l'administration pour tout changement.</p>
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="inline-flex items-center px-3 py-1.5 text-sm text-blue-600 font-medium hover:text-blue-800 border border-transparent rounded hover:bg-blue-50 transition-all duration-200">
                {{ __('Enregistrer') }}
            </button>

            @if (session('status') === 'student-info-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="ml-3 text-sm text-green-600"
                >{{ __('Informations enregistrées.') }}</p>
            @endif
        </div>
    </form>
</section>
