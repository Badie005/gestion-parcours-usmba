<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon Profil') }}
        </h2>
    </x-slot>

    <!-- Navigation de la page de profil -->
    <div class="fixed top-[80px] left-0 right-0 z-40 bg-white/95 backdrop-blur-sm shadow-sm border-b border-gray-200 flex justify-center items-center w-full">
        <div class="max-w-7xl w-full px-4 sm:px-6 lg:px-8 flex justify-center items-center">
            <nav class="inline-flex justify-center items-center space-x-6 py-2 overflow-x-auto no-scrollbar mx-auto text-center">
                <a href="#informations-etudiant" class="px-3 py-1.5 text-sm font-medium text-gray-600 hover:text-blue-600 rounded-md hover:bg-blue-50 transition-all duration-200">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Informations personnelles
                    </span>
                </a>
                <a href="#informations-academiques" class="px-3 py-1.5 text-sm font-medium text-gray-600 hover:text-blue-600 rounded-md hover:bg-blue-50 transition-all duration-200">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                        Parcours
                    </span>
                </a>
                <a href="#resultats-academiques" class="px-3 py-1.5 text-sm font-medium text-gray-600 hover:text-blue-600 rounded-md hover:bg-blue-50 transition-all duration-200">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Résultats
                    </span>
                </a>
                <a href="#securite" class="px-3 py-1.5 text-sm font-medium text-gray-600 hover:text-blue-600 rounded-md hover:bg-blue-50 transition-all duration-200">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Sécurité
                    </span>
                </a>
            </nav>
        </div>
    </div>

    <div class="py-12 mt-20">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Informations étudiant -->
            <div id="informations-etudiant" class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg hover:shadow-lg transition-shadow duration-300 scroll-mt-32" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                <div class="max-w-4xl mx-auto w-full">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Informations Étudiant') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Votre profil et vos informations personnelles") }}
                            </p>
                        </header>

                        <div class="mt-6 space-y-6">
                            <div class="bg-gray-50 rounded-lg p-4 shadow-sm hover:shadow transition-shadow duration-300">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Numéro d'inscription -->
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-500">Numéro d'inscription</h3>
                                        <p class="text-gray-800">{{ $user->num_inscription }}</p>
                                    </div>

                                    <!-- Email académique -->
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-500">Email académique</h3>
                                        <p class="text-gray-800">{{ $user->email_academique }}</p>
                                    </div>

                                    <!-- Prénom -->
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-500">Prénom</h3>
                                        <p class="text-gray-800">{{ $user->prenom_fr }}</p>
                                    </div>

                                    <!-- Nom -->
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-500">Nom</h3>
                                        <p class="text-gray-800">{{ $user->nom_fr }}</p>
                                    </div>

                                    <!-- Date de naissance -->
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-500">Date de naissance</h3>
                                        <p class="text-gray-800">
                                            @php($dn = $user->date_naissance)
                                            {{ $dn ? \Carbon\Carbon::parse($dn)->format('d/m/Y') : '—' }}
                                        </p>
                                    </div>

                                    <!-- Téléphone -->
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-500">Téléphone</h3>
                                        <p class="text-gray-800">{{ $user->telephone ?? '—' }}</p>
                                    </div>
                                </div>

                                <!-- Adresse -->
                                <div class="mt-4">
                                    <h3 class="text-sm font-semibold text-gray-500">Adresse</h3>
                                    <p class="text-gray-800">{{ $user->adresse ?? '—' }}</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Informations académiques -->
            <div id="informations-academiques" class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg hover:shadow-lg transition-shadow duration-300 scroll-mt-32" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                <div class="max-w-4xl mx-auto w-full">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Informations Académiques') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Votre filière et votre parcours d'études") }}
                            </p>
                        </header>

                        <div class="mt-6 space-y-6">
                            <div class="bg-gray-50 rounded-lg p-4 shadow-sm hover:shadow transition-shadow duration-300">
                                <!-- Filière -->
                                <div class="mb-4">
                                    <h3 class="text-sm font-semibold text-gray-500">Filière</h3>
                                    <p class="text-gray-800">{{ $user->filiere?->deug_intitule_fr ?? '—' }}</p>
                                </div>

                                <!-- Parcours -->
                                <div>
                                    <h3 class="text-sm font-semibold text-gray-500">Parcours</h3>
                                    @if($user->parcour)
                                        <div class="mt-1 p-3 bg-white rounded-md border border-gray-200">
                                            <p class="font-medium text-blue-700">{{ $user->parcour->licence_intitule_fr }}</p>
                                            <p class="text-gray-600 text-sm mt-1">{{ $user->parcour->description }}</p>
                                            <div class="flex justify-between items-center mt-3">
                                                <div>
                                                    @if($user->choix_confirme)
                                                        <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700">
                                                            Choix confirmé
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-700 ring-1 ring-inset ring-yellow-700/10">
                                                            En attente de confirmation
                                                        </span>
                                                    @endif
                                                </div>
                                                <div>
                                                    @php($dc = $user->date_choix)
                                                    @if($dc)
                                                        <span class="text-xs text-gray-500">Choisi le {{ \Carbon\Carbon::parse($dc)->format('d/m/Y') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <p class="text-gray-600">Aucun parcours sélectionné</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Résultats académiques -->
            <div id="resultats-academiques" class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg hover:shadow-lg transition-shadow duration-300 scroll-mt-32" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                <div class="max-w-4xl mx-auto w-full">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Résultats Académiques') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Vos résultats par semestre") }}
                            </p>
                        </header>

                        <div class="mt-6">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <div class="overflow-x-auto w-full">
                                    <table class="w-full divide-y divide-gray-200 shadow-sm border border-gray-200 rounded-md">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Semestre</th>
                                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Modules validés</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr>
                                                <td class="px-6 py-3 whitespace-nowrap text-center">S1</td>
                                                <td class="px-6 py-3 whitespace-nowrap text-center font-medium text-gray-800">{{ $user->nb_val_ac_s1 ?? 0 }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-3 whitespace-nowrap text-center">S2</td>
                                                <td class="px-6 py-3 whitespace-nowrap text-center font-medium text-gray-800">{{ $user->nb_val_ac_s2 ?? 0 }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-3 whitespace-nowrap text-center">S3</td>
                                                <td class="px-6 py-3 whitespace-nowrap text-center font-medium text-gray-800">{{ $user->nb_val_ac_s3 ?? 0 }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-3 whitespace-nowrap text-center">S4</td>
                                                <td class="px-6 py-3 whitespace-nowrap text-center font-medium text-gray-800">{{ $user->nb_val_ac_s4 ?? 0 }}</td>
                                            </tr>
                                            <tr class="bg-blue-50 font-semibold">
                                                <td class="px-6 py-3 whitespace-nowrap text-center">Total</td>
                                                <td class="px-6 py-3 whitespace-nowrap text-center text-blue-700">{{ ($user->nb_val_ac_s1 ?? 0) + ($user->nb_val_ac_s2 ?? 0) + ($user->nb_val_ac_s3 ?? 0) + ($user->nb_val_ac_s4 ?? 0) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3 flex justify-end">
                                    <a href="{{ route('resultats.index') }}" class="group inline-flex items-center px-3 py-1.5 text-sm text-blue-600 font-medium hover:text-blue-800 border border-transparent rounded hover:bg-blue-50 transition-all duration-200">
                                        <span>Voir tous les résultats</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 ml-1.5 transform group-hover:translate-x-0.5 transition-transform duration-200" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
    

            <!-- Sécurité - Changement de mot de passe -->
            <div id="securite" class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg hover:shadow-lg transition-shadow duration-300 scroll-mt-32" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                <div class="max-w-4xl mx-auto w-full">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Sécurité') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Gérez la sécurité de votre compte en modifiant votre mot de passe.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-4">
                            @csrf
                            @method('put')

                            <div class="bg-gray-50 rounded-lg p-4 shadow-sm">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="md:col-span-2">
                                        <label for="current_password" class="block text-sm font-medium text-gray-700">{{ __('Mot de passe actuel') }}</label>
                                        <input id="current_password" name="current_password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" autocomplete="current-password" />
                                        @error('current_password', 'updatePassword')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Nouveau mot de passe') }}</label>
                                        <input id="password" name="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" autocomplete="new-password" />
                                        @error('password', 'updatePassword')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('Confirmer le mot de passe') }}</label>
                                        <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" autocomplete="new-password" />
                                        @error('password_confirmation', 'updatePassword')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        {{ __('Changer le mot de passe') }}
                                    </button>

                                    @if (session('status') === 'password-updated')
                                        <p
                                            x-data="{ show: true }"
                                            x-show="show"
                                            x-transition
                                            x-init="setTimeout(() => show = false, 2000)"
                                            class="ml-3 text-sm text-green-600"
                                        >{{ __('Mot de passe modifié avec succès.') }}</p>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
            
            <!-- Boutons de navigation -->
            <div class="flex flex-col sm:flex-row justify-between gap-4 p-4 sm:p-8 bg-white shadow-md sm:rounded-lg" style="pointer-events: auto;">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Retour au tableau de bord
                </a>
                
                @if($user->parcour && $user->choix_confirme)
                    <a href="{{ route('parcours.export-pdf') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>
                        Télécharger l'attestation
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>