<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails du Parcours') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <!-- Lien de retour -->
                    <div class="mb-6">
                        <a href="{{ route('parcours.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Retour à la liste des parcours
                        </a>
                    </div>

                    <!-- Carte Filière -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Filière
                        </h3>
                        <div class="p-4 border border-gray-200 rounded-lg bg-gradient-to-br from-white to-green-50">
                            <div class="flex flex-col md:flex-row justify-between">
                                <div class="mb-2 md:mb-0">
                                    <p class="text-lg font-medium text-green-800">{{ $filiere->deug_intitule_fr }}</p>
                                </div>
                                <div>
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                        Filière ID: {{ $filiere->id_filiere }}
                                    </span>
                                </div>
                            </div>
                            <p class="text-gray-600 mt-2 italic">{{ $filiere->description }}</p>
                        </div>
                    </div>

                    <!-- Détails du parcours -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Détails du parcours
                        </h3>
                        <div class="relative overflow-hidden p-5 border-2 {{ $estParcourChoisi ? 'border-indigo-600' : 'border-indigo-200' }} rounded-lg bg-gradient-to-br from-indigo-50 to-blue-50 shadow-md">
                            
                            @if ($estParcourChoisi)
                            <!-- Badge pour parcours actuellement choisi -->
                            <div class="absolute top-0 right-0 transform translate-x-6 -translate-y-2 rotate-12">
                                <div class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white px-8 py-1.5 text-sm font-semibold rounded-md shadow-md">
                                    Parcours choisi
                                </div>
                            </div>
                            @endif
                            
                            <div class="flex flex-col md:flex-row gap-6">
                                <!-- Icone représentative du parcours -->
                                <div class="flex-shrink-0 mx-auto md:mx-0">
                                    <div class="w-16 h-16 md:w-24 md:h-24 flex items-center justify-center bg-indigo-100 rounded-full border border-indigo-200 text-indigo-700 text-xl font-bold">
                                        {{ substr($parcour->licence_intitule_fr, 0, 2) }}
                                    </div>
                                </div>
                                
                                <!-- Contenu principal du parcours -->
                                <div class="flex-grow text-center md:text-left">
                                    <h4 class="text-xl md:text-2xl font-bold text-indigo-800 mb-2">{{ $parcour->licence_intitule_fr }}</h4>
                                    <p class="text-gray-700 mt-2">{{ $parcour->description }}</p>
                                    
                                    <!-- Détails supplémentaires -->
                                    <div class="mt-4 flex flex-wrap items-center gap-2 justify-center md:justify-start">
                                        <span class="inline-flex items-center rounded-full bg-indigo-100 px-3 py-1 text-xs font-medium text-indigo-800">
                                            ID: {{ $parcour->id_parcour }}
                                        </span>
                                        
                                        @if ($parcour->est_parcour_defaut)
                                            <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Parcours par défaut
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Actions pour ce parcours -->
                            @if ($peutChoisir)
                            <div class="mt-6 border-t border-indigo-100 pt-4">
                                <form action="{{ route('parcours.choisir') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_parcour" value="{{ $parcour->id_parcour }}">
                                    
                                    <div class="mb-4">
                                        <div class="flex items-center">
                                            <input id="confirmer" name="confirmer" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                            <label for="confirmer" class="ml-2 text-sm text-gray-600">
                                                Je confirme vouloir choisir ce parcours
                                            </label>
                                        </div>
                                        @if ($errors->has('confirmer'))
                                            <p class="mt-1 text-sm text-red-600">{{ $errors->first('confirmer') }}</p>
                                        @endif
                                    </div>
                                    
                                    <div>
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Choisir ce parcours
                                        </button>
                                    </div>
                                </form>
                            </div>
                            @elseif ($estParcourChoisi)
                            <div class="mt-6 border-t border-indigo-100 pt-4">
                                <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4">
                                    <p>Vous avez déjà choisi ce parcours. <a href="{{ route('parcours.confirmation') }}" class="underline hover:text-blue-900">Voir la confirmation</a></p>
                                </div>
                            </div>
                            @else
                            <div class="mt-6 border-t border-indigo-100 pt-4">
                                <div class="bg-yellow-50 border-l-4 border-yellow-500 text-yellow-700 p-4">
                                    <p>Vous ne pouvez pas choisir ce parcours car vous avez déjà confirmé votre choix ou la période de choix est terminée.</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
