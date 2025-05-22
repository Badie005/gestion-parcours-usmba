<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des étudiants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Filtres</h3>
                    <form method="GET" action="{{ route('admin.etudiants') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="filiere_id" class="block text-sm font-medium text-gray-700">Filière</label>
                                <select name="filiere_id" id="filiere_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Toutes les filières</option>
                                    @foreach($filieres as $filiere)
                                        <option value="{{ $filiere->code_deug }}" {{ $filiere_id == $filiere->code_deug ? 'selected' : '' }}>
                                            {{ $filiere->deug_intitule_fr }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="parcour_id" class="block text-sm font-medium text-gray-700">Parcours</label>
                                <select name="parcour_id" id="parcour_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Tous les parcours</option>
                                    @foreach($parcours as $parcour)
                                        <option value="{{ $parcour->code_licence }}" {{ $parcour_id == $parcour->code_licence ? 'selected' : '' }}>
                                            {{ $parcour->licence_intitule_fr }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="confirme" class="block text-sm font-medium text-gray-700">Statut</label>
                                <select name="confirme" id="confirme" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Tous les statuts</option>
                                    <option value="1" {{ $confirme === '1' ? 'selected' : '' }}>Choix confirmé</option>
                                    <option value="0" {{ $confirme === '0' ? 'selected' : '' }}>En attente</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Filtrer
                            </button>
                            <a href="{{ route('admin.etudiants') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ml-2">
                                Réinitialiser
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Liste des étudiants</h3>
                        <a href="{{ route('admin.export-csv', request()->query()) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Exporter en CSV
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 text-left">ID</th>
                                    <th class="py-2 px-4 text-left">Nom</th>
                                    <th class="py-2 px-4 text-left">Prénom</th>
                                    <th class="py-2 px-4 text-left">Email</th>
                                    <th class="py-2 px-4 text-left">Filière</th>
                                    <th class="py-2 px-4 text-left">Parcours</th>
                                    <th class="py-2 px-4 text-center">Statut</th>
                                    <th class="py-2 px-4 text-left">Date de choix</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($etudiants as $etudiant)
                                    <tr class="border-t">
                                        <td class="py-2 px-4">{{ $etudiant->num_inscription }}</td>
                                        <td class="py-2 px-4">{{ $etudiant->nom }}</td>
                                        <td class="py-2 px-4">{{ $etudiant->prenom }}</td>
                                        <td class="py-2 px-4">{{ $etudiant->email }}</td>
                                        <td class="py-2 px-4">{{ $etudiant->filiere->deug_intitule_fr ?? 'N/A' }}</td>
                                        <td class="py-2 px-4">{{ $etudiant->parcour->licence_intitule_fr ?? 'Non choisi' }}</td>
                                        <td class="py-2 px-4 text-center">
                                            @if($etudiant->choix_confirme)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Confirmé
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    En attente
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-2 px-4">{{ $etudiant->date_choix ? $etudiant->date_choix->format('d/m/Y H:i') : 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $etudiants->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
