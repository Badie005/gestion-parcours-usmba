# Structure du Rapport de Stage
## Système de Gestion des Parcours Étudiants - USMBA

## 1. Pages Préparatoires

| Élément             | Statut      | Description                                                              |
|---------------------|-------------|--------------------------------------------------------------------------|
| **Page de garde**   | Obligatoire | Logo USMBA, titre du projet, nom étudiant, année, noms des tuteurs        |
| **Dédicace**        | Facultatif  | -                                                                        |
| **Remerciements**   | Obligatoire | Placés après la page de garde                                            |
| **Résumé**          | Obligatoire | 150 mots + version anglaise (ABSTRACT)                                   |
| **Sommaire**        | Obligatoire | Grands titres avec numéros de pages                                       |
| **Liste des figures**| Selon besoin| Schémas, diagrammes, captures d'écran (sur feuille séparée)              |
| **Liste des tableaux**| Selon besoin| Tableaux de données, matrices (sur feuille séparée)                      |
| **Liste des acronymes**| Selon besoin| USMBA, SIE, MVC, PHP, SQL, HTML, CSS, JS, CRUD etc.                      |

## 2. Introduction Générale (1-2 pages)

> *Introduction partielle du rapport global*

### 2.1 Contexte Général du Stage
- Présentation de l'organisme d'accueil : USMBA (Université Sidi Mohamed Ben Abdellah).
  - Historique et développement.
  - Structure organisationnelle (facultés, services pertinents).
- Importance de la transformation numérique dans le secteur de l'éducation supérieure.

### 2.2 Problématique et Objectifs du Projet
- Description du projet : Développement d'une application web pour la gestion des parcours étudiants.
- Problèmes à résoudre (ex: difficultés de suivi, manque de centralisation, processus manuels).
- Objectifs principaux du stage et du projet (ex: améliorer l'efficacité administrative, offrir une meilleure expérience aux étudiants).
- Périmètre fonctionnel attendu du système.

### 2.3 Plan du Rapport
- Annonce de la structure du rapport et brève description de chaque chapitre.

## 3. Développement (Cœur du rapport)

> Chaque chapitre débute par une introduction partielle et se conclut par une conclusion partielle, conformément au guide.

### Chapitre 1 : Cadre du Projet et Analyse de l'Existant (approx. 10-15 pages)

> *Introduction partielle du chapitre 1*

#### 1.1 L'USMBA et la Gestion des Parcours Étudiants
- Rôle spécifique du service ou département d'accueil au sein de l'USMBA.
- Processus existants de gestion des parcours avant le projet (manuels, semi-automatisés).
- Identification des acteurs impliqués (administration, scolarité, étudiants, enseignants).

#### 1.2 Analyse des Besoins et Spécifications
- Recueil des besoins auprès des utilisateurs potentiels.
- Analyse des limitations des systèmes ou processus existants.
- Définition des spécifications fonctionnelles clés :
  - Gestion des informations des étudiants (profils, inscriptions).
  - Gestion des filières et des parcours (création, modification).
  - Processus de choix et de validation des parcours par les étudiants.
  - Suivi de la progression académique.
  - Génération de documents administratifs (ex: attestations).
  - Gestion des utilisateurs et des rôles (étudiants, administrateurs).
- Définition des spécifications non-fonctionnelles :
  - Sécurité des données.
  - Performance et scalabilité.
  - Ergonomie et accessibilité.
  - Maintenabilité et évolutivité.

#### 1.3 Justification des Choix Technologiques Initiaux
- Brève présentation des technologies envisagées et pourquoi (ex: pertinence de Laravel pour un développement rapide et structuré).

> *Conclusion partielle du chapitre 1*

### Chapitre 2 : Conception et Développement du Système (approx. 25-35 pages)

> *Introduction partielle du chapitre 2*

#### 2.1 Architecture et Environnement de Développement
- **Stack Technique Adoptée** : Laravel (PHP), MySQL, Tailwind CSS, JavaScript (Vue.js/React/Alpine.js si applicable).
- **Architecture Logicielle** : Modèle MVC (Modèle-Vue-Contrôleur), approche orientée services.
- **Base de Données** :
  - Schéma conceptuel et relationnel (MCD, MLD).
  - Description des tables principales (ex: `etudiants` avec `num_inscription` comme PK, `filieres`, `parcours`, `action_historiques`, etc.).
  - Prise en compte des relations et contraintes (ex: `id_filiere`).
- **Environnement de Développement** : Outils (VS Code, Composer, NPM/Yarn, Git), serveurs (Apache/Nginx, MySQL).
- **Gestion de Version** : Utilisation de Git et plateformes (GitHub/GitLab).

#### 2.2 Développement Backend
- **Modèles Eloquent** : Implémentation des modèles et de leurs relations.
- **Contrôleurs** : Logique de gestion des requêtes HTTP.
- **Services** : Centralisation de la logique métier (ex: `App\Services\ReNote\AttestationPdfService` pour la génération de PDF sécurisés avec QR code, hash, watermark).
- **Migrations et Seeders** : Gestion de la structure de la base de données et peuplement initial (ex: `TestDataSeeder`, `EtudiantSeeder`, `ActionHistoriqueSeeder` et leur ordre d'exécution).
- **Authentification et Autorisation** : Mécanisme d'authentification (Laravel Auth customisé pour `email_academique`), gestion des rôles et permissions (ex: Spatie Permissions).
- **Sécurité** : Protection contre les failles courantes (XSS, CSRF, injections SQL), validation des données.
- **Logging et Monitoring** : Utilisation de `spatie/laravel-activitylog` pour le suivi des actions, `spatie/laravel-health` pour le health check.
- **Gestion des Tâches Asynchrones** : Utilisation de Laravel Horizon pour les files d'attente (si applicable).

#### 2.3 Développement Frontend
- **Interface Utilisateur (UI)** : Utilisation de Blade pour les vues, intégration de Tailwind CSS pour le style.
- **Expérience Utilisateur (UX)** : Conception d'interfaces intuitives et responsives, respect des préférences USER (boutons modernes, minimalistes, compacts).
- **Composants Réutilisables** : Développement de composants Blade ou JavaScript.
- **Interactivité** : Utilisation de JavaScript pour dynamiser les interfaces (si applicable).

#### 2.4 Implémentation des Fonctionnalités Clés
- **Gestion des Étudiants** : CRUD pour les profils, inscriptions.
- **Gestion des Filières et Parcours** : Création, affichage, modification.
- **Processus de Sélection des Parcours** : Interface pour les étudiants, validation par l'administration, gestion de l'éligibilité (ex: `nb_val_ac_s1` etc.).
- **Génération d'Attestations** : Détail du fonctionnement du `AttestationPdfService`.
- **Historique des Actions** : Suivi des modifications et actions importantes.
- **Tableaux de Bord** : Visualisation des données pour les administrateurs.

#### 2.5 Tests et Validation
- **Tests Unitaires et d'Intégration** : Utilisation de PHPUnit.
- **Tests Fonctionnels** : Scénarios de test pour valider les fonctionnalités.
- **Débogage et Correction** : Outils et méthodes utilisés.

> *Conclusion partielle du chapitre 2*

### Chapitre 3 : Bilan du Stage et Perspectives (approx. 10-15 pages)

> *Introduction partielle du chapitre 3*

#### 3.1 Acquis du Stage
- **Compétences Techniques** : Maîtrise de Laravel, PHP, MySQL, Tailwind CSS, Git, etc.
- **Compétences en Gestion de Projet** : Planification, suivi des tâches, respect des délais.
- **Compétences en Résolution de Problèmes** : Analyse et résolution des bugs et défis techniques.
- **Compétences Relationnelles** : Travail en autonomie, communication avec les encadrants (si applicable).

#### 3.2 Difficultés Rencontrées et Solutions Apportées
- **Défis Techniques Spécifiques** :
  - Problèmes de migration de base de données (ex: `filiere_id` vs `id_filiere`).
  - Gestion des dépendances entre seeders.
  - Complexité de certaines logiques métier (ex: éligibilité, génération de PDF sécurisés).
  - Adaptation à des conventions de nommage ou structures de données existantes.
- **Stratégies de Résolution** : Recherche documentaire, débogage, échanges avec les encadrants, tests itératifs.
- **Leçons Apprises** : Importance de la rigueur, de la communication, de la veille technologique.

#### 3.3 Évaluation du Projet et Auto-évaluation
- Conformité du système développé par rapport aux objectifs initiaux.
- Points forts de la solution (ex: robustesse, maintenabilité, ergonomie).
- Points faibles ou limitations identifiées.
- Bilan personnel sur l'expérience de stage.

#### 3.4 Perspectives d'Évolution du Projet
- Fonctionnalités supplémentaires envisageables (ex: notifications, intégration avec d'autres systèmes de l'USMBA).
- Améliorations techniques possibles (ex: refactoring, optimisation des performances).
- Potentiel de déploiement à plus grande échelle.

> *Conclusion partielle du chapitre 3*

## 4. Conclusion Générale (1-2 pages)

- Rappel des objectifs du stage et du projet.
- Synthèse des principaux résultats obtenus et des réalisations.
- Bilan global de l'expérience professionnelle et des apports du stage.
- Ouverture sur les perspectives d'avenir (professionnelles et pour le projet).

## 5. Références Bibliographiques

- Ouvrages techniques consultés.
- Documentations officielles (Laravel, PHP, MySQL, Tailwind CSS, etc.).
- Articles scientifiques ou de blog pertinents.
- Ressources web (Stack Overflow, forums spécialisés).

## 6. Annexes

> Les annexes doivent être clairement identifiées (Annexe A, Annexe B, etc.) et paginées.

- **Annexe A : Diagrammes Techniques**
  - Schéma de l'architecture globale de l'application.
  - Diagramme de classes (si pertinent).
  - Modèle Conceptuel de Données (MCD) et Modèle Logique de Données (MLD) de la base.
- **Annexe B : Captures d'Écran Clés**
  - Principales interfaces utilisateur (connexion, tableau de bord, sélection de parcours, profil étudiant, etc.).
  - Exemples de documents générés (attestations).
- **Annexe C : Extraits de Code Significatifs**
  - Portions de code illustrant des algorithmes complexes, des configurations spécifiques ou des solutions originales (ex: `AttestationPdfService`, logique d'authentification customisée, une migration complexe).
  - *Ne pas inclure tout le code source, seulement des extraits pertinents et commentés.*
- **Annexe D : Guide d'Installation et de Configuration (simplifié)**
  - Prérequis logiciels (PHP, Composer, Node.js, MySQL).
  - Étapes d'installation (clonage du dépôt, `composer install`, `npm install`, configuration du `.env`, `php artisan key:generate`).
  - Lancement des migrations et seeders (`php artisan migrate --seed`).
  - Accès à l'application.
- **Annexe E : Glossaire (si nécessaire)**
  - Définition des termes techniques ou acronymes spécifiques au projet ou au domaine.

## Présentation Matérielle

### Format du Texte
- **Support** : Papier blanc A4 (210 × 297 mm), recto uniquement.
- **Mise en page** :
  - Marges : 2 cm sur tous les côtés + reliure gauche 0,5 cm.
  - Justification : Alignement gauche et droite.
  - Interligne : 1,5.
  - Espacement paragraphes : 6 pts avant/après.

### Typographie
- **Texte courant** : Times 12 points.
- **Titres de Chapitres** : Times 16 points, gras.
- **Sous-sections (Niveau 1)** : Times 14 points, gras.
- **Sous-sous-sections (Niveau 2)** : Times 12 points, gras.
- **Détails (ex: légendes)** : Times 10 ou 12 points, italique ou normal.

### Règles de Pagination
- Numérotation en chiffres arabes (1, 2, 3...).
- Position : Bas de page, à droite.
- Exception : Page de titre non numérotée. Les pages préparatoires (remerciements, sommaire, etc.) peuvent avoir une numérotation en chiffres romains (i, ii, iii...). 

### Tableaux et Figures
- **Numérotation** : Chiffres arabes par ordre d'apparition dans chaque chapitre (ex: Figure 1.1, Tableau 2.3) ou séquentielle pour tout le document.
- **Présentation** :
  - Titre au-dessus du tableau/figure.
  - Numéro à gauche du titre.
  - Titre explicite et concis.
  - Source si applicable, en dessous.
  - Éviter la coupure sur deux pages si possible.
