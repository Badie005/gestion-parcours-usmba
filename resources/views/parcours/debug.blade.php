@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-4">Déboguer Parcours</h2>
                
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Informations sur l'étudiant</h3>
                    <div class="bg-gray-100 p-4 rounded">
                        <p><strong>Num Inscription:</strong> {{ $etudiant->num_inscription }}</p>
                        <p><strong>Nom:</strong> {{ $etudiant->nom_fr }}</p>
                        <p><strong>Prénom:</strong> {{ $etudiant->prenom_fr }}</p>
                        <p><strong>Email:</strong> {{ $etudiant->email_academique }}</p>
                        <p><strong>Filière ID:</strong> {{ $etudiant->filiere_id }}</p>
                        <p><strong>Parcours ID:</strong> {{ $etudiant->parcour_id }}</p>
                        <p><strong>Choix confirmé:</strong> {{ $etudiant->choix_confirme ? 'Oui' : 'Non' }}</p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Informations sur la filière</h3>
                    @if($filiere)
                    <div class="bg-gray-100 p-4 rounded">
                        <p><strong>Code DEUG:</strong> {{ $filiere->code_deug }}</p>
                        <p><strong>Intitulé:</strong> {{ $filiere->deug_intitule_fr }}</p>
                        <p><strong>Choix Parcours Autorisé:</strong> {{ $filiere->choix_parcour_autorise ? 'Oui' : 'Non' }}</p>
                    </div>
                    @else
                    <div class="bg-red-100 p-4 rounded text-red-700">Aucune filière trouvée pour cet étudiant</div>
                    @endif
                </div>
                
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Parcours disponibles ({{ count($parcours) }})</h3>
                    @if(count($parcours) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($parcours as $parcour)
                        <div class="bg-gray-100 p-4 rounded">
                            <p><strong>Code Licence:</strong> {{ $parcour->code_licence }}</p>
                            <p><strong>Intitulé:</strong> {{ $parcour->licence_intitule_fr }}</p>
                            <p><strong>ID Filière:</strong> {{ $parcour->id_filiere }}</p>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="bg-red-100 p-4 rounded text-red-700">Aucun parcours trouvé pour cette filière</div>
                    @endif
                </div>
                
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Formulaire de test</h3>
                    <form method="POST" action="{{ route('parcours.choisir') }}" class="bg-gray-100 p-4 rounded">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Sélectionner un parcours:
                            </label>
                            <select name="code_licence" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach($parcours as $parcour)
                                <option value="{{ $parcour->code_licence }}">{{ $parcour->licence_intitule_fr }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="confirmation" value="1" class="mr-2" required>
                                <span class="text-gray-700">Je confirme mon choix de parcours</span>
                            </label>
                        </div>
                        
                        <div class="flex items-center">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Tester la soumission
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-2">Historique des actions récentes</h3>
                    @if(count($actions) > 0)
                    <div class="bg-gray-100 p-4 rounded">
                        <ul class="list-disc pl-5">
                            @foreach($actions as $action)
                            <li class="mb-2">
                                <strong>{{ $action->type_action }}</strong> - 
                                {{ $action->description }} 
                                <span class="text-xs text-gray-600">({{ $action->created_at->format('d/m/Y H:i:s') }})</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @else
                    <div class="bg-yellow-100 p-4 rounded text-yellow-700">Aucune action récente</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
