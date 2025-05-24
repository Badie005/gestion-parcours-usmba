<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Résultats Académiques
                </h2>
                <div class="flex space-x-2" style="margin-left: 20px;">
                    <!-- Sélecteur d'année académique -->
                    <div class="relative mr-4">
                        <form id="year-filter-form" method="get" action="{{ route('resultats.index') }}" class="flex items-center">
                            <label for="annee_academique" class="mr-2 text-sm font-medium text-gray-700 dark:text-gray-300">Année:</label>
                            <select id="annee_academique" name="annee_academique" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" onchange="document.getElementById('year-filter-form').submit();">
                                @foreach($anneesDisponibles as $annee)
                                    <option value="{{ $annee }}" {{ $anneeAcademique == $annee ? 'selected' : '' }}>{{ $annee }}-{{ $annee + 1 }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-600 focus:bg-blue-700 dark:focus:bg-blue-600 active:bg-blue-800 dark:active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" style="margin-left: 20px;">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Imprimer
                    </button>
                    <a href="{{ route('resultats.export-pdf', ['annee_academique' => $anneeAcademique]) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" style="margin-left: 20px;">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Export PDF
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Détails des résultats par semestre -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6 hover:shadow-lg transition-shadow duration-300" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-4">Détails des résultats par semestre</h4>
                
                <!-- Onglets pour chaque semestre -->
                <div class="mb-4">
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                            @foreach ($semestres as $index => $semestre)
                                <button 
                                    onclick="showTab('{{ $semestre }}')" 
                                    id="tab-{{ $semestre }}" 
                                    class="{{ $index === 0 ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-3 px-2 border-b-2 font-medium text-sm transition-all duration-200 ease-in-out"
                                    aria-current="{{ $index === 0 ? 'page' : 'false' }}"
                                >
                                    {{ $semestre }}
                                </button>
                            @endforeach
                        </nav>
                    </div>
                </div>

                <!-- Contenu des onglets -->
                @foreach ($semestres as $index => $semestre)
                    <div id="content-{{ $semestre }}" class="tab-content {{ $index === 0 ? 'block' : 'hidden' }}">
                        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Module</th>
                                        <th scope="col" class="px-4 py-2 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Note</th>
                                        <th scope="col" class="px-4 py-2 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Statut</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse ($resultatsParSemestre[$semestre] as $resultat)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150 ease-in-out">
                                            <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">{{ $resultat->titre_module }}</td>
                                            <td class="px-4 py-3 text-center text-sm font-medium {{ $resultat->note >= 10 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                                {{ number_format($resultat->note, 2) }}
                                            </td>
                                            <td class="px-4 py-3 text-center text-sm">
                                                @if($resultat->estValide())
                                                    <span class="px-2 py-1 inline-flex text-xs leading-4 font-medium rounded-md bg-green-50 text-green-700 border border-green-100">
                                                        Validé
                                                    </span>
                                                @else
                                                    <span class="px-2 py-1 inline-flex text-xs leading-4 font-medium rounded-md bg-red-50 text-red-700 border border-red-100">
                                                        Non validé
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                                                Aucun résultat disponible pour ce semestre.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <td colspan="3" class="px-6 py-3 text-right text-sm font-medium text-gray-500 dark:text-gray-300">
                                            Moyenne du semestre :
                                        </td>
                                        <td colspan="2" class="px-6 py-3 text-left text-sm font-bold {{ $moyennesParSemestre[$semestre] >= 10 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                            {{ $moyennesParSemestre[$semestre] ? number_format($moyennesParSemestre[$semestre], 2) : 'N/A' }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Section des statistiques et graphiques -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6 mt-6 hover:shadow-lg transition-shadow duration-300" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-4 cursor-pointer flex items-center" onclick="toggleStatistics()" id="stats-header">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transition-transform duration-300" id="stats-chevron" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    Statistiques
                </h4>
                
                <div id="statistics-content" class="hidden">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Graphique des moyennes -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                        <h5 class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Évolution des moyennes par semestre</h5>
                        <div style="height: 250px;">
                            <canvas id="moyennesChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Graphique des modules validés -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                        <h5 class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Modules validés par semestre</h5>
                        <div style="height: 250px;">
                            <canvas id="modulesChart"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Résumé des résultats -->
                <div class="mt-6 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                    <h5 class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Résumé</h5>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-center">
                        <div class="bg-white dark:bg-gray-800 p-3 rounded-lg shadow-sm">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Modules validés</p>
                            @php
                                $totalModules = 0;
                                foreach ($resultatsParSemestre as $resultats) {
                                    $totalModules += count($resultats);
                                }
                            @endphp
                            <p class="text-xl font-bold text-blue-600 dark:text-blue-400">{{ array_sum($modulesValides) }} / {{ $totalModules }}</p>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 p-3 rounded-lg shadow-sm">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Moyenne générale</p>
                            @php
                                $filteredMoyennes = array_filter($moyennesParSemestre);
                                $moyenneGenerale = count($filteredMoyennes) > 0 ? array_sum($filteredMoyennes) / count($filteredMoyennes) : 0;
                            @endphp
                            <p class="text-xl font-bold {{ $moyenneGenerale >= 10 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ count($filteredMoyennes) > 0 ? number_format($moyenneGenerale, 2) : 'N/A' }}
                            </p>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 p-3 rounded-lg shadow-sm">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Semestres validés</p>
                            <p class="text-xl font-bold text-blue-600 dark:text-blue-400">
                                {{ array_sum($semestreValide) }} / {{ count($semestreValide) }}
                            </p>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 p-3 rounded-lg shadow-sm">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Taux de réussite</p>
                            @php
                                $totalModules = 0;
                                foreach ($resultatsParSemestre as $resultats) {
                                    $totalModules += count($resultats);
                                }
                                $tauxReussite = $totalModules > 0 ? (array_sum($modulesValides) / $totalModules) * 100 : 0;
                            @endphp
                            <p class="text-xl font-bold text-blue-600 dark:text-blue-400">
                                {{ $totalModules > 0 ? number_format($tauxReussite, 1) : 'N/A' }}{{ $totalModules > 0 ? '%' : '' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Configuration du thème des graphiques
        const isDarkMode = document.documentElement.classList.contains('dark');
        const textColor = isDarkMode ? 'rgba(255, 255, 255, 0.8)' : 'rgba(0, 0, 0, 0.8)';
        const gridColor = isDarkMode ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
        
        // Données pour les graphiques
        const semestres = @json($semestres);
        const moyennes = @json(array_map(function($m) { return $m ?: 0; }, $moyennesParSemestre));
        const modulesValides = @json(array_values($modulesValides));
        
        // Graphique des moyennes
        const moyennesCtx = document.getElementById('moyennesChart').getContext('2d');
        const moyennesChart = new Chart(moyennesCtx, {
            type: 'line',
            data: {
                labels: semestres,
                datasets: [{
                    label: 'Moyenne',
                    data: moyennes,
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                }, {
                    label: 'Seuil de validation',
                    data: [10, 10, 10, 10],
                    borderColor: 'rgba(59, 130, 246, 0.5)',
                    borderWidth: 2,
                    borderDash: [5, 5],
                    fill: false,
                    pointRadius: 0,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: textColor
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 20,
                        grid: {
                            color: gridColor
                        },
                        ticks: {
                            color: textColor
                        }
                    },
                    x: {
                        grid: {
                            color: gridColor
                        },
                        ticks: {
                            color: textColor
                        }
                    }
                }
            }
        });
        
        // Graphique des modules validu00e9s
        const modulesCtx = document.getElementById('modulesChart').getContext('2d');
        const modulesChart = new Chart(modulesCtx, {
            type: 'bar',
            data: {
                labels: semestres,
                datasets: [{
                    label: 'Modules validu00e9s',
                    data: modulesValides,
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1,
                    borderRadius: 5,
                }, {
                    label: 'Total des modules',
                    data: [7, 7, 7, 7],
                    backgroundColor: 'rgba(209, 213, 219, 0.5)',
                    borderColor: 'rgba(209, 213, 219, 1)',
                    borderWidth: 1,
                    borderRadius: 5,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: textColor
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 8,
                        grid: {
                            color: gridColor
                        },
                        ticks: {
                            color: textColor,
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            color: gridColor
                        },
                        ticks: {
                            color: textColor
                        }
                    }
                }
            }
        });
        
        // Fonction pour changer d'onglet
        function showTab(semestre) {
            // Cacher tous les contenus
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('block');
            });
            
            // Afficher le contenu sélectionné
            document.getElementById('content-' + semestre).classList.add('block');
            document.getElementById('content-' + semestre).classList.remove('hidden');
            
            // Mettre à jour les styles des onglets
            document.querySelectorAll('[id^="tab-"]').forEach(tab => {
                tab.classList.remove('border-blue-500', 'text-blue-600');
                tab.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            });
            
            // Mettre en évidence l'onglet sélectionné
            document.getElementById('tab-' + semestre).classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            document.getElementById('tab-' + semestre).classList.add('border-blue-500', 'text-blue-600');
        }
        
        // Fonction pour basculer l'affichage de la section des statistiques
        function toggleStatistics() {
            const content = document.getElementById('statistics-content');
            const chevron = document.getElementById('stats-chevron');
            
            if (content.classList.contains('hidden')) {
                // Afficher le contenu
                content.classList.remove('hidden');
                chevron.style.transform = 'rotate(180deg)';
            } else {
                // Cacher le contenu
                content.classList.add('hidden');
                chevron.style.transform = 'rotate(0)';
            }
        }
        
        // Initialiser la section des statistiques (cachée par défaut)
        document.addEventListener('DOMContentLoaded', function() {
            const chevron = document.getElementById('stats-chevron');
            chevron.style.transform = 'rotate(0)';
        });
    </script>

    <!-- Styles d'impression -->
    <style>
        @media print {
            header, nav, footer, .no-print {
                display: none !important;
            }
            
            body {
                background-color: white !important;
            }
            
            .max-w-7xl {
                max-width: none !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            
            .py-12 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
            
            .tab-content.hidden {
                display: block !important;
                margin-bottom: 2rem;
                page-break-after: always;
            }
            
            h4 {
                page-break-before: always;
            }
            
            canvas {
                max-height: 400px !important;
            }
        }
    </style>
</x-app-layout>
