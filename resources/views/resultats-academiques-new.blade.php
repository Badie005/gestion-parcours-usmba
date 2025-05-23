<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Ru00e9sultats Acadu00e9miques') }}
            </h2>
            <div class="flex space-x-2">
                <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Imprimer
                </button>
                <a href="{{ route('resultats.export-pdf') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    Export PDF
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Carte d'information de l'u00e9tudiant -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex flex-col md:flex-row justify-between">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                            <span class="text-gray-500 dark:text-gray-400">Nom :</span> {{ $etudiant->nom_fr }} {{ $etudiant->prenom_fr }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-1">
                            <span class="font-medium">Nu00b0 d'inscription :</span> {{ $etudiant->num_inscription }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-400 mb-1">
                            <span class="font-medium">Filiu00e8re :</span> {{ $etudiant->filiere ? $etudiant->filiere->libelle_filiere : 'Non du00e9finie' }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-400">
                            <span class="font-medium">Parcours :</span> {{ $etudiant->parcour ? $etudiant->parcour->libelle_parcour : 'Non du00e9fini' }}
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0 text-right">
                        <div class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg">
                            <span class="font-medium text-gray-700 dark:text-gray-300 mr-2">Moyenne gu00e9nu00e9rale :</span>
                            @php
                                $moyenneGenerale = 0;
                                $count = 0;
                                foreach ($moyennesParSemestre as $moyenne) {
                                    if ($moyenne) {
                                        $moyenneGenerale += $moyenne;
                                        $count++;
                                    }
                                }
                                $moyenneGenerale = $count > 0 ? $moyenneGenerale / $count : null;
                            @endphp
                            @if($moyenneGenerale)
                                <span class="text-lg font-bold {{ $moyenneGenerale >= 10 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                    {{ number_format($moyenneGenerale, 2) }}
                                </span>
                            @else
                                <span class="text-lg font-bold text-gray-500 dark:text-gray-400">N/A</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Synthu00e8se graphique -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-4">Progression acadu00e9mique</h4>
                
                <!-- Graphique des moyennes -->
                <div class="mb-6">
                    <h5 class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Moyennes par semestre</h5>
                    <div class="h-60 w-full">
                        <canvas id="moyennesChart"></canvas>
                    </div>
                </div>
                
                <!-- Graphique des modules validu00e9s -->
                <div>
                    <h5 class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Modules validu00e9s par semestre</h5>
                    <div class="h-60 w-full">
                        <canvas id="modulesChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Du00e9tails des semestres -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-4">Du00e9tails des ru00e9sultats par semestre</h4>
                
                <!-- Synthu00e8se des ru00e9sultats -->
                <div class="mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                        @foreach ($semestres as $semestre)
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200 border-l-4 {{ $semestreValide[$semestre] ? 'border-green-500' : 'border-yellow-500' }}">
                                <h5 class="font-bold text-center mb-2">{{ $semestre }}</h5>
                                <div class="text-center mb-2">
                                    <span class="font-medium">Moyenne :</span> 
                                    <span class="{{ $moyennesParSemestre[$semestre] >= 10 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }} font-bold">
                                        {{ $moyennesParSemestre[$semestre] ? number_format($moyennesParSemestre[$semestre], 2) : 'N/A' }}
                                    </span>
                                </div>
                                <div class="text-center mb-2">
                                    <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ($modulesValides[$semestre] / 7) * 100 }}%"></div>
                                    </div>
                                    <span class="text-sm font-medium mt-1 block">{{ $modulesValides[$semestre] }}/7 modules validu00e9s</span>
                                </div>
                                <div class="text-center">
                                    <span class="font-medium">Statut :</span> 
                                    @if($semestreValide[$semestre])
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">Validu00e9</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">En cours</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Onglets pour chaque semestre -->
                <div class="mb-4">
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            @foreach ($semestres as $index => $semestre)
                                <button 
                                    onclick="showTab('{{ $semestre }}')" 
                                    id="tab-{{ $semestre }}" 
                                    class="{{ $index === 0 ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
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
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Code</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Module</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Coefficient</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Note</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Statut</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse ($resultatsParSemestre[$semestre] as $resultat)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150 ease-in-out">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $resultat->code_module }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $resultat->titre_module }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $resultat->coefficient }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold {{ $resultat->note >= 10 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                                {{ number_format($resultat->note, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @if($resultat->statut === 'validu00e9')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                                        Validu00e9
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">
                                                        Non validu00e9
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                                                Aucun ru00e9sultat disponible pour ce semestre.
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
        </div>
    </div>

    <!-- Scripts pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Configuration du thu00e8me des graphiques
        const isDarkMode = document.documentElement.classList.contains('dark');
        const textColor = isDarkMode ? 'rgba(255, 255, 255, 0.8)' : 'rgba(0, 0, 0, 0.8)';
        const gridColor = isDarkMode ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
        
        // Donnu00e9es pour les graphiques
        const semestres = @json($semestres);
        const moyennes = @json(array_map(function($m) { return $m ?: 0; }, $moyennesParSemestre));
        const modulesValides = @json($modulesValides);
        
        // Graphique des moyennes
        const moyennesCtx = document.getElementById('moyennesChart').getContext('2d');
        const moyennesChart = new Chart(moyennesCtx, {
            type: 'line',
            data: {
                labels: semestres,
                datasets: [{
                    label: 'Moyenne',
                    data: moyennes,
                    backgroundColor: 'rgba(79, 70, 229, 0.2)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(79, 70, 229, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                }, {
                    label: 'Seuil de validation',
                    data: [10, 10, 10, 10],
                    borderColor: 'rgba(220, 38, 38, 0.5)',
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
                    backgroundColor: 'rgba(16, 185, 129, 0.7)',
                    borderColor: 'rgba(16, 185, 129, 1)',
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
            
            // Afficher le contenu su00e9lectionnu00e9
            document.getElementById('content-' + semestre).classList.remove('hidden');
            document.getElementById('content-' + semestre).classList.add('block');
            
            // Mettre u00e0 jour les classes des onglets
            document.querySelectorAll('[id^="tab-"]').forEach(tab => {
                tab.classList.remove('border-indigo-500', 'text-indigo-600');
                tab.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                tab.setAttribute('aria-current', 'false');
            });
            
            document.getElementById('tab-' + semestre).classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            document.getElementById('tab-' + semestre).classList.add('border-indigo-500', 'text-indigo-600');
            document.getElementById('tab-' + semestre).setAttribute('aria-current', 'page');
        }
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
