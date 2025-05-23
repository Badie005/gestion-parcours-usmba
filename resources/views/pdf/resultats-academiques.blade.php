<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Résultats Académiques - {{ $etudiant->nom_fr }} {{ $etudiant->prenom_fr }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .student-info {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .semestre-header {
            background-color: #f9f9f9;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            margin: 15px 0;
            border: 1px solid #ddd;
        }
        .summary {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .summary-box {
            border: 1px solid #ddd;
            padding: 10px;
            width: 22%;
            text-align: center;
        }
        .passed {
            color: green;
        }
        .failed {
            color: red;
        }
        .footer {
            margin-top: 30px;
            font-size: 10px;
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Université Sidi Mohamed Ben Abdellah</h1>
        <h2>Relevé des Résultats Académiques</h2>
    </div>
    
    <div class="student-info">
        <p><strong>Nom et Prénom:</strong> {{ $etudiant->nom_fr }} {{ $etudiant->prenom_fr }}</p>
        <p><strong>N° d'Inscription:</strong> {{ $etudiant->num_inscription }}</p>
        <p><strong>Filière:</strong> {{ $etudiant->filiere ? $etudiant->filiere->libelle_filiere : 'Non définie' }}</p>
        <p><strong>Parcours:</strong> {{ $etudiant->parcour ? $etudiant->parcour->libelle_parcour : 'Non défini' }}</p>
    </div>
    
    <div class="summary">
        @foreach ($semestres as $semestre)
            <div class="summary-box">
                <h3>{{ $semestre }}</h3>
                <p><strong>Moyenne:</strong> <span class="{{ $moyennesParSemestre[$semestre] >= 10 ? 'passed' : 'failed' }}">{{ $moyennesParSemestre[$semestre] ? number_format($moyennesParSemestre[$semestre], 2) : 'N/A' }}</span></p>
                <p><strong>Modules validés:</strong> {{ $modulesValides[$semestre] }}/7</p>
                <p><strong>Statut:</strong> <span class="{{ $semestreValide[$semestre] ? 'passed' : 'failed' }}">{{ $semestreValide[$semestre] ? 'Validé' : 'Non validé' }}</span></p>
            </div>
        @endforeach
    </div>
    
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
    
    <p class="text-center"><strong>Moyenne Générale:</strong> <span class="{{ $moyenneGenerale >= 10 ? 'passed' : 'failed' }}">{{ $moyenneGenerale ? number_format($moyenneGenerale, 2) : 'N/A' }}</span></p>
    
    @foreach ($semestres as $semestre)
        <div class="semestre-header">{{ $semestre }}</div>
        
        @if($resultatsParSemestre[$semestre]->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Module</th>
                        <th>Coefficient</th>
                        <th>Note</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resultatsParSemestre[$semestre] as $resultat)
                        <tr>
                            <td>{{ $resultat->code_module }}</td>
                            <td>{{ $resultat->titre_module }}</td>
                            <td>{{ $resultat->coefficient }}</td>
                            <td class="{{ $resultat->note >= 10 ? 'passed' : 'failed' }}">{{ number_format($resultat->note, 2) }}</td>
                            <td class="{{ $resultat->statut === 'validé' ? 'passed' : 'failed' }}">{{ $resultat->statut === 'validé' ? 'Validé' : 'Non validé' }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right"><strong>Moyenne du semestre:</strong></td>
                        <td colspan="2" class="{{ $moyennesParSemestre[$semestre] >= 10 ? 'passed' : 'failed' }}"><strong>{{ $moyennesParSemestre[$semestre] ? number_format($moyennesParSemestre[$semestre], 2) : 'N/A' }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        @else
            <p class="text-center">Aucun résultat disponible pour ce semestre.</p>
        @endif
    @endforeach
    
    <div class="footer">
        <p>Document généré le {{ date('d/m/Y à H:i') }} - Ce document est fourni à titre informatif uniquement.</p>
        <p>Université Sidi Mohamed Ben Abdellah - Gestion des Parcours Étudiants</p>
    </div>
</body>
</html>
