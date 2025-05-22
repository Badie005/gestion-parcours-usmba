<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon Profil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Informations étudiant -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-4xl mx-auto w-3/5">
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
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Numéro d'inscription -->
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-500">Numéro d'inscription</h3>
                                        <p class="text-gray-800">{{ $user->Num_Inscription }}</p>
                                    </div>

                                    <!-- Email académique -->
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-500">Email académique</h3>
                                        <p class="text-gray-800">{{ $user->Email_academique }}</p>
                                    </div>

                                    <!-- Prénom -->
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-500">Prénom</h3>
                                        <p class="text-gray-800">{{ $user->Prenom_Fr }}</p>
                                    </div>

                                    <!-- Nom -->
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-500">Nom</h3>
                                        <p class="text-gray-800">{{ $user->Nom_Fr }}</p>
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

                            <!-- Informations académiques -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="text-md font-semibold text-gray-700 mb-3">Informations académiques</h3>
                                
                                <!-- Filière -->
                                <div class="mb-4">
                                    <h3 class="text-sm font-semibold text-gray-500">Filière</h3>
                                    <p class="text-gray-800">{{ $user->filiere?->Deug_Intitule_Fr ?? '—' }}</p>
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

                            <!-- Résultats académiques -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-md font-semibold text-gray-700 mb-4">Résultats académiques</h3>
                                
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
                            </div>

                            <div class="flex justify-between">
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                                    </svg>
                                    Retour au tableau de bord
                                </a>
                                
                                @if($user->parcour && $user->choix_confirme)
                                    <a href="{{ route('parcours.export-pdf') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                        </svg>
                                        Télécharger l'attestation
                                    </a>
                                @endif
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
