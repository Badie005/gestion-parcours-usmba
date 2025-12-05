<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Choix de Parcours') }}
        </h2>
    </x-slot>

    <div class="py-8" style="padding-top: 48px;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="padding-top: 40px;">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border border-gray-200">
                <div class="p-8 text-gray-900">
                    <!-- Les messages flash sont maintenant gérés par le composant dans le layout -->
                    
                    <div class="mb-8 bg-gray-50 p-6 rounded-lg border-l-4 border-blue-800 shadow-sm">
                        <div class="flex items-start">
                            <div class="shrink-0 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3 flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">À propos du choix de parcours</h3>
                                <p class="text-gray-700 mb-3">Cette page vous permet de choisir le parcours que vous souhaitez suivre dans le cadre de votre filière d'études.</p>
                                <ul class="list-disc list-inside space-y-1 text-gray-700 ml-1">
                                    <li>Prenez le temps de consulter la description de chaque parcours disponible.</li>
                                    <li>Certaines filières ne permettent pas de choisir votre parcours - dans ce cas, le parcours par défaut vous est automatiquement attribué.</li>
                                    <li>Une fois votre choix effectué et confirmé, vous recevrez une confirmation que vous pourrez télécharger en format PDF.</li>
                                    <li class="font-medium">La date limite pour confirmer votre choix est le <strong class="text-gray-900">30 juin 2025</strong>.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8 bg-gray-50 rounded-lg p-6 shadow-sm border border-gray-200">
                        <h3 class="text-lg font-semibold mb-4 border-b pb-2 border-gray-200 text-gray-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Informations de l'étudiant
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-3">
                                <p class="flex"><span class="font-medium w-32 text-gray-700">Nom complet :</span> <span class="text-gray-900">{{ $etudiant->nom_complet }}</span></p>
                                <p class="flex"><span class="font-medium w-32 text-gray-700">Email :</span> <span class="text-gray-900">{{ $etudiant->email }}</span></p>
                                <p class="flex"><span class="font-medium w-32 text-gray-700">Date de naissance :</span> <span class="text-gray-900">{{ $etudiant->date_naissance->format('d/m/Y') }}</span></p>
                            </div>
                            <div class="space-y-3 md:border-l md:border-gray-200 md:pl-6">
                                <p><span class="font-medium text-gray-700">Filière :</span> <span class="text-gray-900 font-semibold">{{ $filiere->deug_intitule_fr }}</span></p>
                                <p><span class="font-medium text-gray-700">Description :</span> <span class="text-gray-900 italic">{{ $filiere->description }}</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-8">
                        @if (!$peutChoisir)
                            @if (isset($erreurParcourDefaut) && $erreurParcourDefaut)
                                <x-parcours-notification 
                                    type="error" 
                                    title="Erreur de configuration" 
                                    dismissible="false"
                                >
                                    <p class="mb-3">Votre filière <strong>{{ $filiere->deug_intitule_fr }}</strong> ne permet pas de choisir votre parcours, mais aucun parcours par défaut n'a été configuré.</p>
                                    <p class="mb-1">Veuillez contacter l'administration pour résoudre ce problème :</p>
                                    <ul class="list-disc list-inside space-y-1 text-gray-700 mb-3">
                                        <li>Un parcours par défaut doit être défini pour votre filière</li>
                                        <li>Votre inscription ne peut pas être finalisée tant que ce problème n'est pas résolu</li>
                                    </ul>
                                    <p class="text-sm text-gray-500 italic">Référence erreur: FIL-DEF-{{ $filiere->id_filiere }}-{{ date('Ymd') }}</p>
                                </x-parcours-notification>
                                
                                <!-- Encadré d'erreur -->
                                <div class="bg-red-50/50 p-1 rounded-lg mb-6 shadow-sm">
                                    <div class="rounded-lg overflow-hidden border border-red-200">
                                        <!-- En-tête -->
                                        <div class="bg-gradient-to-r from-red-500 to-red-700 p-4">
                                            <div class="flex items-center">
                                                <svg class="h-6 w-6 text-white mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                                </svg>
                                                <h3 class="text-lg font-semibold text-white">Configuration manquante</h3>
                                            </div>
                                        </div>
                                        
                                        <!-- Corps -->
                                        <div class="bg-white p-5">
                                            <h4 class="text-xl font-bold text-red-600 mb-2">Parcours par défaut non défini</h4>
                                            <p class="text-gray-600 mb-4">L'administrateur doit configurer un parcours par défaut pour la filière <strong>{{ $filiere->deug_intitule_fr }}</strong>.</p>
                                            <div class="mt-4 pt-4 border-t border-gray-100">
                                                <div class="inline-flex items-center text-sm text-red-600">
                                                    <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                                    </svg>
                                                    Contacter le secrétariat pédagogique pour assistance
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <x-parcours-notification 
                                    type="warning" 
                                    title="Choix automatique" 
                                    dismissible="false"
                                >
                                    <p class="mb-3">Votre filière <strong>{{ $filiere->deug_intitule_fr }}</strong> ne permet pas de choisir votre parcours.</p>
                                    <p class="mb-1">Le parcours par défaut vous a été automatiquement attribué selon les règles académiques suivantes :</p>
                                    <ul class="list-disc list-inside space-y-1 text-gray-700 mb-3">
                                        <li>Les étudiants de certaines filières ont un parcours prédéfini obligatoire</li>
                                        <li>Le choix est automatisé pour garantir une répartition équilibrée des étudiants</li>
                                        <li>Ce parcours est adapté aux prérequis de votre profil académique</li>
                                    </ul>
                                    <p class="text-sm text-gray-500 italic">Pour plus d'informations, contactez le secrétariat de votre département.</p>
                                </x-parcours-notification>

                                <!-- Parcours attribué avec design amélioré -->
                                <div class="bg-gray-50/50 p-1 rounded-lg mb-6 shadow-sm">
                                    <div class="rounded-lg overflow-hidden border border-blue-200">
                                        <!-- En-tête -->
                                        <div class="bg-gradient-to-r from-gray-700 to-gray-900 p-4">
                                            <div class="flex items-center">
                                                <svg class="h-6 w-6 text-white mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                                </svg>
                                                <h3 class="text-lg font-semibold text-white">Votre parcours attribué</h3>
                                            </div>
                                        </div>
                                        
                                        <!-- Corps -->
                                        <div class="bg-white p-5">
                                            <h4 class="text-xl font-bold text-blue-800 mb-2">{{ $parcourDefaut->licence_intitule_fr }}</h4>
                                            <p class="text-gray-600 mb-4">{{ $parcourDefaut->description }}</p>
                                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                                <div class="inline-flex items-center text-sm text-blue-800">
                                                    <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Attribution automatique
                                                </div>
                                                <span class="inline-flex items-center rounded-full bg-gray-200 px-3 py-0.5 text-sm font-medium text-gray-900">
                                                    Parcours par défaut
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="mt-10 flex justify-center">
                                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 w-full max-w-lg text-center shadow-sm">
                                    <div class="flex items-center justify-center mb-4 text-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold mb-3 text-gray-900">Parcours déjà attribué</h4>
                                    <p class="mb-4 text-gray-600">Votre parcours a été automatiquement attribué. Vous pouvez consulter les détails de votre confirmation.</p>
                                    <a href="{{ route('parcours.confirmation') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-800 to-black border border-transparent rounded-md font-semibold text-base text-white uppercase tracking-wide hover:from-blue-700 hover:to-blue-800 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md  w-full justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                        Voir ma confirmation
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="border-t border-gray-200 pt-6">
                                <h3 class="text-lg font-semibold mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    Choisissez votre parcours
                                </h3>

                                <form method="POST" action="{{ route('parcours.choisir') }}">
                                    @csrf
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                        @foreach($parcours as $parcour)
                                        <div class="relative">
                                            <input type="radio" name="code_licence" id="parcour_{{ $parcour->code_licence }}" value="{{ $parcour->code_licence }}" class="peer hidden" {{ $loop->first ? 'checked' : '' }} required>
                                            <label for="parcour_{{ $parcour->code_licence }}" class="flex flex-col h-full border border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50  peer-checked:border-blue-500 peer-checked:ring-2 peer-checked:ring-blue-500 peer-checked:bg-blue-50 transition-all duration-200 overflow-hidden shadow-sm bg-white">
                                                <!-- En-tête -->
                                                <div class="p-3 bg-gradient-to-r from-blue-600 to-blue-800 text-black group-hover:from-blue-700 group-hover:to-blue-900 transition-all duration-200">
                                                    <div class="flex justify-between items-center">
                                                        <h4 class="font-medium text-sm">{{ $parcour->licence_intitule_fr }}</h4>
                                                        @if($parcour->est_parcour_defaut)
                                                        <span class="inline-flex items-center rounded-full bg-white/20 px-2 py-0.5 text-xs text-black">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                            Défaut
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <!-- Corps -->
                                                <div class="p-3 flex-grow flex flex-col">
                                                    <div class="mb-2">
                                                        <span class="inline-flex items-center text-xs font-medium text-gray-500">
                                                            Code: {{ $parcour->code_licence }}
                                                        </span>
                                                    </div>
                                                    
                                                    <p class="text-sm text-gray-600 flex-grow">{{ $parcour->description }}</p>
                                                    
                                                    <!-- Indicateur de sélection -->
                                                    <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100">
                                                        <span class="text-xs font-medium peer-checked:text-blue-600 text-gray-500 group-hover:text-blue-600 transition-colors duration-200">Sélectionner</span>
                                                        <div class="peer-checked:bg-blue-600 bg-gray-200 group-hover:bg-blue-400 group-hover:shadow rounded-full w-5 h-5 flex items-center justify-center transition-all duration-200">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="mb-4 bg-gray-50 p-3 rounded-lg border border-gray-200">
                                        <div class="flex items-center">
                                        <input id="confirmer" name="confirmer" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" required>
                                        <label for="confirmer" class="ml-2 text-sm text-gray-700">
                                            Je confirme mon choix de parcours
                                        </label>
                                    </div>
                                    @error('confirmer')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror

                                    <!-- Bouton de confirmation -->
                                    <div class="flex justify-end">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Confirmer mon choix
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
        </div>
    </div>
</x-app-layout>
