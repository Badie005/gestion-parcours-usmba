<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                {{ __('Tableau de bord') }}
            </h2>
            <span class="hidden sm:inline-block text-sm text-slate-500 bg-white px-3 py-1 rounded-full shadow-sm border border-slate-200">
                Année Universitaire {{ date('Y') }}-{{ date('Y')+1 }}
            </span>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg p-6 sm:p-10 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-2xl sm:text-3xl font-bold mb-2">Bonjour, {{ Auth::user()->prenom_fr }} ! 👋</h3>
                    <p class="text-blue-100 max-w-2xl text-lg">Bienvenue sur votre espace étudiant USMBA. Suivez votre parcours, consultez vos résultats et gérez vos choix académiques en toute simplicité.</p>
                </div>
                <div class="absolute right-0 top-0 h-full w-1/3 bg-white/10 transform skew-x-12 translate-x-12 pointer-events-none"></div>
                <div class="absolute right-10 bottom-0 h-32 w-32 bg-yellow-400/20 rounded-full blur-3xl pointer-events-none"></div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Status Card 1: Profil -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-green-600 bg-green-50 px-2.5 py-1 rounded-full border border-green-100">ACTIF</span>
                    </div>
                    <h4 class="text-lg font-bold text-slate-800 mb-1">Mon Profil</h4>
                    <p class="text-slate-500 text-sm mb-4">Gérez vos informations personnelles</p>
                    <a href="{{ route('profile.edit') }}" class="text-blue-600 text-sm font-semibold hover:text-blue-700 flex items-center">
                        Accéder au profil <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>

                <!-- Status Card 2: Parcours -->
                @php
                    $hasParcours = Auth::user()->parcour_id !== null;
                    $filiere = Auth::user()->filiere;
                    $peutChoisir = !$hasParcours && $filiere && ($filiere->choix_parcour_autorise ?? false);
                @endphp
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 {{ $hasParcours ? 'bg-green-50 text-green-600 group-hover:bg-green-600' : ($peutChoisir ? 'bg-yellow-50 text-yellow-600 group-hover:bg-yellow-600' : 'bg-slate-50 text-slate-600 group-hover:bg-slate-600') }} rounded-xl group-hover:text-white transition-colors duration-300 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold {{ $hasParcours ? 'text-green-600 bg-green-50 border-green-100' : ($peutChoisir ? 'text-yellow-600 bg-yellow-50 border-yellow-100' : 'text-slate-500 bg-slate-50 border-slate-100') }} px-2.5 py-1 rounded-full border">
                            {{ $hasParcours ? 'VALIDÉ' : ($peutChoisir ? 'ACTION REQUISE' : 'EN ATTENTE') }}
                        </span>
                    </div>
                    <h4 class="text-lg font-bold text-slate-800 mb-1">Parcours Académique</h4>
                    <p class="text-slate-500 text-sm mb-4">{{ $hasParcours ? 'Votre parcours est confirmé' : ($peutChoisir ? 'Vous devez choisir votre spécialité' : 'Parcours non encore disponible') }}</p>
                    <a href="{{ route('parcours.index') }}" class="text-blue-600 text-sm font-semibold hover:text-blue-700 flex items-center">
                        {{ $hasParcours ? 'Voir mon parcours' : 'Choisir maintenant' }} <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>

                <!-- Status Card 3: Résultats -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-purple-50 text-purple-600 rounded-xl group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-purple-600 bg-purple-50 px-2.5 py-1 rounded-full border border-purple-100">NOTES</span>
                    </div>
                    <h4 class="text-lg font-bold text-slate-800 mb-1">Résultats</h4>
                    <p class="text-slate-500 text-sm mb-4">Consultez vos notes et relevés</p>
                    <a href="{{ route('resultats.index') }}" class="text-blue-600 text-sm font-semibold hover:text-blue-700 flex items-center">
                        Voir les résultats <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column: Info -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                            <h3 class="font-bold text-slate-800 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                Informations Académiques
                            </h3>
                            <span class="text-xs font-mono text-slate-400 bg-slate-100 px-2 py-1 rounded">ID: {{ Auth::user()->num_inscription }}</span>
                        </div>
                        <div class="p-6">
                             <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                                <div>
                                    <dt class="text-sm font-medium text-slate-500">Nom Complet</dt>
                                    <dd class="mt-1 text-sm font-semibold text-slate-900">{{ Auth::user()->nom_fr }} {{ Auth::user()->prenom_fr }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-slate-500">Email Académique</dt>
                                    <dd class="mt-1 text-sm font-semibold text-slate-900">{{ Auth::user()->email_academique }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-slate-500">Filière</dt>
                                    <dd class="mt-1 text-sm font-semibold text-slate-900">{{ Auth::user()->filiere->deug_intitule_fr ?? 'Non définie' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-slate-500">Parcours</dt>
                                    <dd class="mt-1">
                                        @if(Auth::user()->parcour)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ Auth::user()->parcour->licence_intitule_fr }}
                                            </span>
                                        @else
                                            <span class="text-sm text-slate-400 italic">Non défini</span>
                                        @endif
                                    </dd>
                                </div>
                             </dl>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Timeline -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden h-full">
                        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                            <h3 class="font-bold text-slate-800 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Activité Récente
                            </h3>
                        </div>
                        <div class="p-6">
                            @if($historique->isEmpty())
                                <div class="text-center py-8 text-slate-400">
                                    <p class="text-sm">Aucune activité récente.</p>
                                </div>
                            @else
                                <div class="flow-root">
                                    <ul role="list" class="-mb-8">
                                        @foreach($historique->take(5) as $action)
                                            <li>
                                                <div class="relative pb-8">
                                                    @if(!$loop->last)
                                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-slate-200" aria-hidden="true"></span>
                                                    @endif
                                                    <div class="relative flex space-x-3">
                                                        <div>
                                                            <span class="{{ $action->color_class ?? 'bg-blue-500' }} h-8 w-8 rounded-full flex items-center justify-center ring-4 ring-white shadow-sm">
                                                                <svg class="h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $action->icon ?? 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' }}" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                            <div>
                                                                <p class="text-sm text-slate-800 font-medium">{{ $action->description }}</p>
                                                            </div>
                                                            <div class="whitespace-nowrap text-right text-xs text-slate-400">
                                                                <time datetime="{{ $action->created_at }}">{{ $action->created_at->diffForHumans() }}</time>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
