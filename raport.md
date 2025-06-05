# Rapport de Stage
## Système de Gestion des Parcours Étudiants - USMBA

## 1. Pages Préparatoires

### Page de garde
[À compléter avec les informations personnelles]

### Remerciements
Je tiens à remercier sincèrement :
- L'Université Sidi Mohamed Ben Abdellah pour m'avoir accueilli
- Mon encadrant universitaire pour son soutien et ses conseils
- L'équipe pédagogique pour leur disponibilité
- Tous ceux qui ont contribué à la réussite de ce projet

### Résumé
Ce rapport présente la conception et le développement d'un système de gestion des parcours étudiants pour l'Université Sidi Mohamed Ben Abdellah (USMBA). Le projet vise à moderniser et automatiser le processus de gestion des parcours académiques en remplaçant les méthodes manuelles par une solution numérique robuste. Développé avec Laravel et Tailwind CSS, le système offre une interface intuitive pour la gestion des profils étudiants, le suivi des résultats académiques et la sélection des parcours. Cette solution contribue à l'amélioration de l'efficacité administrative et à une meilleure expérience utilisateur pour les étudiants.

### Abstract
This report presents the design and development of a student pathway management system for Sidi Mohamed Ben Abdellah University (USMBA). The project aims to modernize and automate the academic pathway management process by replacing manual methods with a robust digital solution. Developed with Laravel and Tailwind CSS, the system provides an intuitive interface for managing student profiles, tracking academic results, and selecting pathways. This solution contributes to improving administrative efficiency and providing a better user experience for students.

## 2. Introduction

### 2.1 Présentation de l'USMBA
L'Université Sidi Mohamed Ben Abdellah (USMBA) est une institution d'enseignement supérieur publique marocaine, située à Fès. Elle accueille des milliers d'étudiants répartis dans différentes filières et parcours académiques. La gestion des parcours étudiants représente un défi majeur pour l'administration, nécessitant une solution numérique adaptée.

### 2.2 Mission spécifique
La mission principale consistait à développer un système web permettant :
- La gestion des profils étudiants
- Le suivi des résultats académiques
- La sélection et validation des parcours
- La génération de documents officiels
- Le suivi des actions et modifications

### 2.3 Plan de rédaction
Ce rapport est structuré en trois chapitres principaux :
1. Organisation et Contexte
2. Réalisation du Projet
3. Bilan et Perspectives

## 3. Développement

### Chapitre 1 : Organisation et Contexte

#### 1.1 Structure de l'USMBA
L'analyse de la structure organisationnelle révèle :
- Une organisation hiérarchique claire
- Des services interdépendants
- Un besoin de coordination entre les départements
- Une nécessité de centralisation des données

#### 1.2 Analyse de l'existant
Le système actuel présente plusieurs limitations :
- Processus manuels chronophages
- Risques d'erreurs humaines
- Manque de traçabilité
- Difficultés de coordination

#### 1.3 Enjeux et défis
Les principaux enjeux identifiés sont :
- Modernisation des processus
- Sécurisation des données
- Amélioration de l'efficacité
- Satisfaction des utilisateurs

### Chapitre 2 : Réalisation du Projet

#### 2.1 Technologies et outils
Stack technique utilisée :
- Backend : Laravel 10.x
- Frontend : Blade + Tailwind CSS
- Base de données : MySQL
- Outils de développement : Git, Composer, npm

#### 2.2 Développement Backend
Architecture MVC implémentée :
- Modèles : Etudiant, Parcours, Filiere, etc.
- Contrôleurs : Gestion des requêtes HTTP
- Services : Logique métier
- Middleware : Authentification et autorisation

#### 2.3 Développement Frontend
Interface utilisateur développée avec :
- Blade pour les templates
- Tailwind CSS pour le style
- Composants réutilisables
- Design responsive

#### 2.4 Fonctionnalités principales
Système complet incluant :
- Authentification sécurisée
- Gestion des profils
- Suivi des résultats
- Sélection des parcours
- Génération de PDF

### Chapitre 3 : Bilan et Perspectives

#### 3.1 Apports personnels
Compétences développées :
- Maîtrise de Laravel
- Gestion de projet
- Développement full-stack
- Résolution de problèmes

#### 3.2 Difficultés et solutions
Défis rencontrés :
- Intégration avec systèmes existants
- Gestion des performances
- Sécurisation des données
- Solutions techniques apportées

#### 3.3 Perspectives d'évolution
Améliorations futures :
- Intégration API
- Fonctionnalités avancées
- Optimisations techniques
- Évolutions métier

## 4. Conclusion Générale
Le projet a permis de :
- Moderniser la gestion des parcours
- Améliorer l'efficacité administrative
- Faciliter le travail des utilisateurs
- Poser les bases d'une évolution future

## 5. Références Bibliographiques
- Documentation Laravel
- Standards web
- Articles techniques
- Ressources académiques

## 6. Annexes

### Annexe A : Documentation technique
- Schémas d'architecture
- Diagrammes de base de données
- Flux de travail

### Annexe B : Captures d'écran
- Interfaces principales
- Fonctionnalités clés

### Annexe C : Code source
- Extraits de code significatifs
- Commentaires techniques

### Annexe D : Guide d'installation
- Prérequis
- Procédure d'installation
- Configuration

sequenceDiagram
  participant E as Étudiant
  participant F as Frontend
  participant C as Contrôleur
  participant S as Service
  participant DB as Base de données

  E->>F: Sélectionne un parcours
  F->>C: Envoie la requête de choix
  C->>S: Vérifie l'éligibilité
  S->>DB: Récupère les résultats académiques
  S-->>C: Retourne l'éligibilité
  C->>DB: Enregistre le choix
  C->>F: Confirme la sélection

graph TD
  A["Utilisateur (étudiant)"] -->|Navigateur| B["Frontend (Blade + Tailwind)"]
  B -->|Requêtes HTTP| C["Contrôleurs Laravel"]
  C -->|Appels| D["Services Métier"]
  D -->|Accès| E["Base de données MySQL"]
  C -->|Génération| F["PDF (DomPDF)"]
  C -->|Vue| B

erDiagram
  ETUDIANT ||--o{ PARCOURS : "choisit"
  ETUDIANT }o--|| FILIERE : "appartient à"
  PARCOURS }o--|| FILIERE : "dépend de"
  ETUDIANT ||--o{ HISTORIQUE : "effectue"
