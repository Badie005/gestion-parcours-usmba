<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Confirmation de votre Parcours') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg hover:shadow-lg transition-shadow duration-300" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                <div class="p-6 text-gray-900">
                    <!-- Les messages flash sont maintenant gérés par le composant dans le layout -->

                    <!-- Bannière de félicitation avec animation -->
                    <div class="relative overflow-hidden mb-8 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                        <div class="absolute inset-0 bg-gradient-to-r from-[#00143f] to-[#0061ff] opacity-90"></div>
                        <div class="absolute inset-0 opacity-20 bg-indigo-900 bg-opacity-30"></div>
                        <div class="relative px-6 py-8 md:px-10 text-white text-center">
                            <div class="flex justify-center mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-bold tracking-tight mb-2">Félicitations !</h2>
                            <p class="text-lg text-blue-100">Votre choix de parcours {{ isset($parcour) && isset($parcour->licence_intitule_fr) ? ' "'.$parcour->licence_intitule_fr.'"' : '' }} a été enregistré et confirmé avec succès.</p>
                            <p class="text-sm text-blue-200 mt-2">Vous pouvez télécharger votre confirmation en format PDF ou revenir au tableau de bord.</p>
                        </div>
                    </div>

                    <!-- Carte d'informations de l'étudiant avec animation à l'entrée -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Informations de l'étudiant
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 p-4 border border-gray-200 hover:border-blue-300 transition-all duration-300 rounded-lg bg-gradient-to-br from-white to-blue-50 shadow-md hover:shadow-lg" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                            <div>
                                <p><span class="font-medium">Nom complet :</span> {{ $etudiant->nom_complet ?? 'Non renseigné' }}</p>
                                <p><span class="font-medium">Email :</span> {{ $etudiant->email ?? 'Non renseigné' }}</p>
                                <p><span class="font-medium">Date de naissance :</span> {{ $etudiant->formatted_date_naissance ?? 'Non renseignée' }}</p>
                            </div>
                            <div>
                                <p><span class="font-medium">Adresse :</span> {{ $etudiant->adresse ?? 'Non renseignée' }}</p>
                                <p><span class="font-medium">Téléphone :</span> {{ $etudiant->telephone ?? 'Non renseigné' }}</p>
                                <p><span class="font-medium">Date du choix :</span> {{ $etudiant->formatted_date_choix ?? 'Non renseignée' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Carte Filière avec animation à l'entrée -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Filière
                        </h3>
                        <div class="p-4 border border-gray-200 hover:border-green-300 rounded-lg bg-white shadow-md hover:shadow-lg transition-shadow duration-300" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">

                            <div class="flex flex-col md:flex-row justify-between">
                                <div class="mb-2">
                                    <h3 class="text-lg font-semibold text-green-700">{{ $filiere->deug_intitule_fr ?? 'Filière' }}</h3>
                                </div>
                                <div>
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                        ID: {{ $filiere->Code_DEUG ?? 'Non renseigné' }}
                                    </span>
                                </div>
                            </div>
                            <p class="text-gray-600 mt-2 italic">{{ $filiere->description ?? 'Aucune description disponible' }}</p>
                        </div>
                    </div>

                    <!-- Carte Parcours choisi avec animation à l'entrée et effet highlight -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Parcours choisi
                        </h3>
                        <div class="relative p-5 border border-gray-200 rounded-lg bg-white shadow-md hover:shadow-lg transition-all duration-200 hover:border-blue-300" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">

                            <!-- Badge de confirmation -->
                            <div class="absolute top-3 right-3">
                                <div class="flex items-center bg-blue-600 text-white px-2.5 py-1 text-xs font-medium rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Confirmé
                                </div>
                            </div>
                            
                            <div class="flex flex-col md:flex-row gap-6">
                                <!-- Icone représentative du parcours -->
                                <div class="flex-shrink-0 mx-auto md:mx-0">
                                    <div style="background-color:rgb(0, 86, 223);" class="w-16 h-16 md:w-20 md:h-20 flex items-center justify-center rounded-full text-white shadow-sm font-bold text-xl transition-all duration-200 hover:shadow-md">
                                        @php
                                            $initiales = $parcour->licence_intitule_fr ?? 'PAR';
                                            $initiales = mb_strtoupper(mb_substr($initiales, 0, 3, 'UTF-8'));
                                        @endphp
                                        {{ $initiales }}
                                    </div>
                                </div>
                                
                                <!-- Contenu principal du parcours -->
                                <div class="flex-grow text-center md:text-left">
                                    <h4 class="text-lg font-bold text-gray-800 mb-1">{{ $parcour->licence_intitule_fr ?? 'Parcours sélectionné' }}</h4>
                                    <p class="text-gray-600 text-sm">{{ $parcour->description ?? 'Aucune description disponible pour ce parcours.' }}</p>
                                    
                                    <!-- Détails supplémentaires -->
                                    <div class="mt-4 flex flex-wrap items-center gap-2 justify-center md:justify-start">
                                        <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">
                                            ID: {{ $parcour->Code_Licence }}
                                        </span>
                                        
                                        @if ($parcour->est_parcour_defaut)
                                            <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Parcours par défaut
                                            </span>
                                        @endif
                                        
                                        <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Choisi le {{ $etudiant->formatted_date_choix ?? now()->format('d/m/Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section des boutons d'action avec animations à l'entrée -->
                    <div class="border-t border-gray-100 pt-8 pb-4">
                        <div class="flex flex-col sm:flex-row justify-between gap-4">
                            <!-- Bouton retour au dashboard - Style minimaliste moderne -->
                            <a href="{{ route('dashboard') }}" class="group inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-md font-medium text-sm transition-all duration-200 hover:bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transition-transform duration-200 group-hover:-translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                <span>Tableau de bord</span>
                            </a>

                            <!-- Bouton télécharger PDF - Style minimaliste moderne -->
                            <a href="{{ route('parcours.export-pdf') }}" class="group inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md font-medium text-sm transition-all duration-200 hover:bg-blue-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>Télécharger PDF</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>