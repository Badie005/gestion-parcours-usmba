<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rapports et statistiques') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistiques par filière -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Statistiques par filière</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 text-left">Filière</th>
                                    <th class="py-2 px-4 text-center">Nombre d'étudiants</th>
                                    <th class="py-2 px-4 text-center">Choix confirmés</th>
                                    <th class="py-2 px-4 text-center">Nombre de parcours</th>
                                    <th class="py-2 px-4 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats_filieres as $filiere)
                                    <tr class="border-t">
                                        <td class="py-2 px-4">{{ $filiere->deug_intitule_fr }}</td>
                                        <td class="py-2 px-4 text-center">{{ $filiere->etudiants_count }}</td>
                                        <td class="py-2 px-4 text-center">{{ $filiere->etudiants_confirmes_count }}</td>
                                        <td class="py-2 px-4 text-center">{{ $filiere->parcours_count }}</td>
                                        <td class="py-2 px-4 text-center">
                                            <a href="{{ route('admin.export-csv', ['filiere_id' => $filiere->id_filiere]) }}" class="text-indigo-600 hover:text-indigo-900">
                                                Exporter CSV
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Statistiques par parcours -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Répartition des étudiants par parcours</h3>
                    <div class="mb-4">
                        <div id="chart-parcours" style="height: 350px;"></div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 text-left">Parcours</th>
                                    <th class="py-2 px-4 text-left">Filière</th>
                                    <th class="py-2 px-4 text-center">Nombre d'étudiants</th>
                                    <th class="py-2 px-4 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats_parcours as $parcour)
                                    <tr class="border-t">
                                        <td class="py-2 px-4">{{ $parcour->licence_intitule_fr }}</td>
                                        <td class="py-2 px-4">{{ $parcour->filiere->deug_intitule_fr }}</td>
                                        <td class="py-2 px-4 text-center">{{ $parcour->etudiants_count }}</td>
                                        <td class="py-2 px-4 text-center">
                                            <a href="{{ route('admin.export-csv', ['parcour_id' => $parcour->code_licence]) }}" class="text-indigo-600 hover:text-indigo-900">
                                                Exporter CSV
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const data = JSON.parse('{!! $data_graph !!}');
            
            // Grouper les données par filière pour le graphique
            const filieres = {};
            data.forEach(item => {
                if (!filieres[item.filiere]) {
                    filieres[item.filiere] = [];
                }
                filieres[item.filiere].push({
                    x: item.label,
                    y: item.value
                });
            });
            
            // Préparer les séries pour le graphique
            const series = Object.keys(filieres).map(filiere => {
                return {
                    name: filiere,
                    data: filieres[filiere]
                };
            });
            
            const options = {
                series: series,
                chart: {
                    type: 'bar',
                    height: 350,
                    stacked: false
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    title: {
                        text: 'Parcours'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Nombre d\'étudiants'
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + " étudiants"
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'left',
                    offsetX: 40
                }
            };

            const chart = new ApexCharts(document.querySelector("#chart-parcours"), options);
            chart.render();
        });
    </script>
    @endpush
</x-app-layout>
