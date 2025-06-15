<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord étudiant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">

            <!-- Section d'état du profil et des étapes -->
            <div class="mb-6 rounded-lg shadow-md border border-blue-50 overflow-hidden" style="background: transparent !important;">
                <div class="p-5 max-w-7xl mx-auto w-full rounded-lg shadow-md bg-white" style="pointer-events: auto; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">

                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#0085c7] dark:text-[#A8F1FF]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Progression de votre parcours académique
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- État du profil -->
                        <div class="bg-white p-4 rounded-lg shadow-md border border-blue-50 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-center">
                                <div class="rounded-full p-2 mr-3 bg-blue-100 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-blue-700">
                                        Profil étudiant
                                    </h4>
                                    <p class="text-sm text-gray-600">
                                        Informations personnelles
                                    </p>
                                </div>
                            </div>
                            <div class="mt-2 text-right">
                                <a href="{{ route('profile.edit') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                    Voir mon profil →
                                </a>
                            </div>
                        </div>
                        
                        <!-- État du choix de parcours -->
                        @php
                        $peutChoisir = false;
                        try {
                            $filiere = \App\Models\Filiere::find($etudiant->filiere_id);
                            $peutChoisir = !$etudiant->choix_confirme && $filiere && ($filiere->choix_parcour_autorise ?? false);
                        } catch(\Exception $e) {}
                        @endphp
                        <div class="bg-white p-4 rounded-lg shadow-md border {{ $hasParcours ? 'border-green-100' : ($peutChoisir ? 'border-yellow-100' : 'border-gray-100') }} hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-center">
                                <div class="rounded-full p-2 mr-3 {{ $hasParcours ? 'bg-green-50 text-green-600' : ($peutChoisir ? 'bg-yellow-50 text-yellow-600' : 'bg-gray-50 text-gray-600') }}">
                                    @if($hasParcours)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    @elseif($peutChoisir)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-semibold {{ $hasParcours ? 'text-green-700' : ($peutChoisir ? 'text-yellow-700' : 'text-gray-700') }}">
                                        Choix de parcours
                                    </h4>
                                    <p class="text-sm text-gray-600">
                                        @if($hasParcours)
                                            Parcours confirmé
                                        @elseif($peutChoisir)
                                            En attente de choix
                                        @else
                                            Attribué automatiquement
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="mt-2 text-right">
                                <a href="{{ route('parcours.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                    {{ $hasParcours ? 'Voir mon parcours' : ($peutChoisir ? 'Choisir un parcours' : 'Voir le parcours attribué') }} →
                                </a>
                            </div>
                        </div>
                        
                        <!-- État de l'attestation -->
                        <div class="bg-white p-4 rounded-lg shadow-md border {{ $hasParcours ? 'border-green-100' : 'border-gray-100' }} hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-center">
                                <div class="rounded-full p-2 mr-3 {{ $hasParcours ? 'bg-green-50 text-green-600' : 'bg-gray-50 text-gray-600' }}">
                                    @if($hasParcours)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-semibold {{ $hasParcours ? 'text-green-700' : 'text-gray-700' }}">
                                        Attestation PDF
                                    </h4>
                                    <p class="text-sm text-gray-600">
                                        @if($hasParcours)
                                            Prêt à télécharger
                                        @else
                                            Non disponible
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="mt-2 text-right">
                                @if($hasParcours)
                                    <a href="{{ route('parcours.export-pdf') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                        Télécharger PDF →
                                    </a>
                                @else
                                    <span class="text-sm text-gray-500">
                                        Choisissez un parcours pour télécharger l'attestation
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Carte d'information principale -->
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg mb-6 hover:shadow-lg transition-shadow duration-300" style="pointer-events: auto; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ Auth::user()->nom_fr ?? '' }} {{ Auth::user()->prenom_fr ?? '' }}</h3>
                            <p class="text-gray-600">{{ Auth::user()->email_academique ?? Auth::user()->email ?? '' }}</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            @if (Auth::user()->parcour_id)
                                <span class="inline-flex items-center rounded-md bg-green-50 px-3 py-2 text-sm font-medium text-green-800 ring-1 ring-inset ring-green-600/20">
                                    <svg class="mr-1.5 h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Parcours choisi
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-md bg-yellow-50 px-3 py-2 text-sm font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">
                                    <svg class="mr-1.5 h-4 w-4 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                    </svg>
                                    Choix de parcours non effectué
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Informations personnelles -->
                        <div class="bg-gray-50 p-5 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-700 mb-3">Informations personnelles</h4>
                            <div class="space-y-2">
                                <div class="flex">
                                    <span class="text-gray-500 min-w-32">Nom complet:</span>
                                    <span class="font-medium">{{ Auth::user()->nom_fr ?? '' }} {{ Auth::user()->prenom_fr ?? '' }}</span>
                                </div>
                                <div class="flex">
                                    <span class="text-gray-500 min-w-32">Date de naissance:</span>
                                    <span class="font-medium">
                                        @php $dn = Auth::user()->date_naissance @endphp
                                        {{ $dn ? \Carbon\Carbon::parse($dn)->format('d/m/Y') : '—' }}
                                    </span>
                                </div>
                                <div class="flex">
                                    <span class="text-gray-500 min-w-32">Adresse:</span>
                                    <span class="font-medium">{{ Auth::user()->adresse }}</span>
                                </div>
                                <div class="flex">
                                    <span class="text-gray-500 min-w-32">Téléphone:</span>
                                    <span class="font-medium">{{ Auth::user()->telephone }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Informations académiques -->
                        <div class="bg-gray-50 p-5 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-700 mb-3">Informations académiques</h4>
                            <div class="space-y-3">
                                <div class="flex">
                                    <span class="text-gray-500 min-w-32">Filière:</span>
                                    <span class="font-medium">{{ Auth::user()->filiere->deug_intitule_fr ?? 'Non définie' }}</span>
                                </div>
                                @if (Auth::user()->parcour_id)
                                    <div class="flex flex-col">
                                        <span class="text-gray-500 mb-1">Parcours choisi:</span>
                                        <div class="mt-1 p-3 bg-white rounded-md border border-gray-200">
                                            <p class="font-medium text-blue-700">{{ Auth::user()->parcour->licence_intitule_fr ?? 'Parcours sélectionné' }}</p>
                                            <p class="text-gray-600 text-sm mt-1">{{ Auth::user()->parcour->description ?? '' }}</p>
                                            <div class="flex justify-between items-center mt-3">
                                                <div>
                                                    @if(Auth::user()->choix_confirme ?? false)
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
                                                    @php
                                                        $dc = Auth::user()->date_choix ?? null;
                                                        $formatted_date = '';
                                                        if ($dc) {
                                                            try {
                                                                $formatted_date = \Carbon\Carbon::parse($dc)->format('d/m/Y');
                                                            } catch (\Exception $e) {}
                                                        }
                                                    @endphp
                                                    {{ $formatted_date }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div>
                                        <p class="text-gray-500">Vous n'avez pas encore choisi de parcours.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center mt-6">
                        @if (Auth::user()->parcour_id)
                            <a href="{{ route('parcours.confirmation') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Voir ma confirmation
                            </a>
                        @else
                            <a href="{{ route('parcours.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Choisir mon parcours
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Historique des actions -->
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg hover:shadow-lg transition-shadow duration-300" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">

                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Historique des actions</h3>

                    @if($historique->isEmpty())
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="mt-2 text-gray-500">Aucune action enregistrée pour le moment.</p>
                        </div>
                    @else
                        <div class="flow-root">
                            <ul role="list" class="-mb-8">
                                @foreach($historique as $index => $action)
                                    <li>
                                        <div class="relative pb-8">
                                            @if(!$loop->last)
                                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                            @endif
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span class="{{ $action->color_class }} h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white">
                                                        <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $action->icon }}" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                    <div>
                                                        <p class="text-sm text-gray-900">{{ $action->description }}</p>
                                                        @if($action->donnees_additionnelles)
                                                            <div class="mt-1 text-xs text-gray-500">
                                                                @php
                                                                    $donnees = $action->donnees_additionnelles;
                                                                    if (is_string($donnees)) {
                                                                        try {
                                                                            $donnees = json_decode($donnees, true);
                                                                        } catch (\Exception $e) {
                                                                            $donnees = [];
                                                                        }
                                                                    }
                                                                    $donnees = is_array($donnees) ? $donnees : [];
                                                                @endphp
                                                                @foreach($donnees as $key => $value)
                                                                    @if(!is_array($value))
                                                                        <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 mr-1 mb-1">
                                                                            {{ ucfirst(str_replace('_', ' ', $key)) }}: {{ $value }}                                                                
                                                                        </span>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                                        <time datetime="{{ $action->created_at->format('Y-m-d\TH:i:s') }}">
                                                            @if($action->created_at->isToday())
                                                                Aujourd'hui à {{ $action->created_at->format('H:i') }}
                                                            @elseif($action->created_at->isYesterday())
                                                                Hier à {{ $action->created_at->format('H:i') }}
                                                            @else
                                                                {{ $action->created_at->format('d/m/Y à H:i') }}
                                                            @endif
                                                        </time>
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
</x-app-layout>
