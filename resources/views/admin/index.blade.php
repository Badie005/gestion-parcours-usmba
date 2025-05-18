<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord administratif') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistiques générales -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Statistiques générales</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <p class="text-sm text-blue-600">Total des étudiants</p>
                            <p class="text-2xl font-bold">{{ $stats['total_etudiants'] }}</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <p class="text-sm text-green-600">Parcours confirmés</p>
                            <p class="text-2xl font-bold">{{ $stats['parcours_confirmes'] }}</p>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <p class="text-sm text-yellow-600">En attente de confirmation</p>
                            <p class="text-2xl font-bold">{{ $stats['parcours_non_confirmes'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Actions rapides</h3>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('admin.etudiants') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Gérer les étudiants
                        </a>
                        <a href="{{ route('admin.rapports') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Voir les rapports
                        </a>
                        <a href="{{ route('admin.export-csv') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                            Exporter tous les étudiants (CSV)
                        </a>
                    </div>
                </div>
            </div>

            <!-- Dernières activités -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Dernières activités</h3>
                    @if(count($dernieres_activites) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="py-2 px-4 text-left">Étudiant</th>
                                        <th class="py-2 px-4 text-left">Filière</th>
                                        <th class="py-2 px-4 text-left">Parcours</th>
                                        <th class="py-2 px-4 text-left">Date de confirmation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dernieres_activites as $etudiant)
                                        <tr class="border-t">
                                            <td class="py-2 px-4">{{ $etudiant->nom }} {{ $etudiant->prenom }}</td>
                                            <td class="py-2 px-4">{{ $etudiant->filiere->deug_intitule_fr ?? 'N/A' }}</td>
                                            <td class="py-2 px-4">{{ $etudiant->parcour->licence_intitule_fr ?? 'N/A' }}</td>
                                            <td class="py-2 px-4">{{ $etudiant->date_choix ? $etudiant->date_choix->format('d/m/Y H:i') : 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">Aucune activité récente</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
