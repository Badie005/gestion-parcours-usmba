<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Confirmation de Parcours</title>
    <style>
        @page {
            margin: 1.2cm;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 9pt;
            line-height: 1.2;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        /* Couleurs */
        .univ-color {
            color: #19508D; /* Bleu universitaire */
        }
        .bg-gray {
            background-color: #DCDCDC; /* Gris clair */
        }
        
        /* En-tête et pied de page */
        .header {
            border-bottom: 1pt solid #19508D;
            padding-bottom: 5pt;
            margin-bottom: 10pt;
        }
        .header-left {
            font-weight: bold;
            font-size: 8pt;
            float: left;
        }
        .header-right {
            float: right;
            font-size: 8pt;
        }
        .footer {
            text-align: center;
            font-size: 7pt;
            color: #555;
            margin-top: 8pt;
            border-top: 0.5pt solid #19508D;
            padding-top: 3pt;
        }
        
        /* Titre et intro */
        .title {
            font-size: 16pt;
            color: #19508D;
            font-weight: bold;
            text-align: center;
            margin-bottom: 2pt;
        }
        .subtitle {
            font-size: 8pt;
            font-style: italic;
            text-align: center;
            margin-bottom: 2pt;
        }
        .generation-date {
            font-size: 7pt;
            text-align: center;
            margin-bottom: 6pt;
        }
        .intro {
            font-size: 7pt;
            font-style: italic;
            text-align: center;
            margin: 0 auto;
            width: 80%;
            margin-bottom: 8pt;
        }
        
        /* Sections */
        .section-title {
            color: #19508D;
            font-size: 10pt;
            font-weight: bold;
            margin-top: 8pt;
            margin-bottom: 5pt;
            border-bottom: 1pt solid #19508D;
        }
        
        /* Tableaux */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8pt;
        }
        table, th, td {
            border: 1px solid #CCCCCC;
        }
        th {
            font-size: 8pt;
            color: #19508D;
            font-weight: bold;
            text-align: left;
            padding: 3pt;
            width: 25%;
        }
        td {
            font-size: 8pt;
            padding: 3pt;
        }
        .highlighted {
            background-color: #DCDCDC;
            font-weight: bold;
        }
        
        /* Validation section */
        .validation-table td {
            text-align: center;
            height: 50pt;
            vertical-align: middle;
        }
        .signature-area {
            margin: 0 auto;
            border-bottom: 1pt solid #000;
            width: 80%;
            height: 30pt;
        }
        .date-line {
            margin-top: 3pt;
            font-size: 7pt;
        }
        .stamp-area {
            margin: 0 auto;
            border: 1pt dashed #999;
            width: 60pt;
            height: 30pt;
            position: relative;
        }
        .stamp-text {
            position: absolute;
            bottom: -12pt;
            width: 100%;
            text-align: center;
            font-size: 6pt;
        }
        
        /* Utilitaires */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <div class="header clearfix">
        <div class="header-left">Département d'Informatique</div>
        <div class="header-right">Année académique {{ now()->format('Y') }}-{{ now()->addYear()->format('Y') }}</div>
    </div>
    
    <!-- Titre et introduction -->
    <div class="title">CONFIRMATION DE CHOIX DE PARCOURS</div>
    <div class="subtitle">Document officiel</div>
    <div class="generation-date">Généré le {{ now()->format('d/m/Y') }}</div>
    
    <div class="intro">
        Ce document atteste du choix de parcours de l'étudiant et fait office de document officiel auprès de l'administration universitaire.
    </div>
    
    <!-- Référence du document -->
    <div>
        <strong>Référence :</strong> GPE-{{ str_pad($etudiant->num_inscription, 5, '0', STR_PAD_LEFT) }}-{{ now()->format('Ymd') }}
    </div>
    
    <!-- Section Étudiant -->
    <div class="section-title">Informations de l'Étudiant</div>
    <table>
        <tr>
            <th>Nom complet</th>
            <td>{{ $etudiant->nom_complet ?? 'Non renseigné' }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $etudiant->email ?? 'Non renseigné' }}</td>
        </tr>
        <tr>
            <th>Date de naissance</th>
            <td>{{ $etudiant->formatted_date_naissance ?? 'Non renseignée' }}</td>
        </tr>
    </table>
    
    <!-- Section Filière -->
    <div class="section-title">Informations de la Filière</div>
    <table>
        <tr>
            <th>Nom</th>
            <td>{{ $filiere->deug_intitule_fr ?? 'Non renseigné' }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $filiere->description ?? 'Non renseigné' }}</td>
        </tr>
        <tr>
            <th>Département</th>
            <td>Sciences et Technologies</td>
        </tr>
    </table>
    
    <!-- Section Parcours -->
    <div class="section-title">Parcours Choisi</div>
    <table>
        <tr class="highlighted">
            <th>Nom du parcours</th>
            <td><strong>{{ $parcour->licence_intitule_fr ?? 'Non renseigné' }}</strong></td>
        </tr>
        <tr class="highlighted">
            <th>Statut</th>
            <td><strong>Confirmé</strong></td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $parcour->description ?? 'Non renseigné' }}</td>
        </tr>
        <tr>
            <th>Date du choix</th>
            <td>{{ $etudiant->formatted_date_choix ?? now()->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <th>Année académique</th>
            <td>{{ now()->format('Y') }}-{{ now()->addYear()->format('Y') }}</td>
        </tr>
    </table>
    
    <!-- Section Validation (version compacte) -->
    <div class="section-title">Validation</div>
    <table class="validation-table">
        <tr>
            <th style="width:50%">Signature de l'Étudiant</th>
            <th style="width:50%">Cachet de l'Administration</th>
        </tr>
        <tr>
            <td style="height:40pt;vertical-align:bottom">
                <div style="border-bottom:1pt solid #000;width:90%;margin:0 auto;"></div>
                <div style="font-size:6pt;text-align:center;margin-top:2pt;">Date: _________________</div>
            </td>
            <td style="height:40pt;">
                <div style="border:1pt dashed #999;width:50pt;height:25pt;margin:0 auto;">
                    <div style="font-size:6pt;text-align:center;margin-top:28pt;">Tampon officiel</div>
                </div>
            </td>
        </tr>
    </table>
    
    <!-- Pied de page -->
    <div class="footer">
        <p>Ce document est généré automatiquement par l'application de Gestion des Parcours Étudiants.</p>
        <p>Pour toute question, veuillez contacter l'administration à l'adresse: administration@universite.fr</p>
    </div>
</body>
</html>
