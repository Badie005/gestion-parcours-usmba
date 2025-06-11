# Gestion des Parcours Étudiants - USMBA

<p align="center">
  <img src="public/logo.png" alt="Logo Gestion Parcours Étudiants" width="200" />
</p>

## À propos de l'application

Application web complète pour la gestion des parcours universitaires à l'Université Sidi Mohamed Ben Abdellah (USMBA). Cette solution offre une plateforme sécurisée et intuitive pour la gestion des inscriptions, le suivi académique et l'orientation des étudiants.

### Fonctionnalités principales

#### Authentification & Sécurité
- Authentification sécurisée via email académique USMBA
- Changement de mot de passe obligatoire à la première connexion
- Protection contre les attaques par force brute
- Journalisation détaillée des actions sensibles

#### Gestion des Profils
- Tableau de bord personnalisé pour chaque étudiant
- Mise à jour des informations personnelles
- Visualisation des résultats académiques
- Suivi en temps réel de l'état du dossier

#### Gestion Académique
- Consultation des filières et parcours disponibles
- Système de choix de parcours intelligent
- Validation automatique des prérequis académiques
- Génération d'attestations PDF sécurisées avec QR code

#### Fonctionnalités Avancées
- Génération de documents officiels (attestations, relevés de notes)
- Système de suivi des actions utilisateurs
- Interface d'administration complète
- Tableaux de bord analytiques

## Technologies Utilisées

### Backend
- **Framework**: Laravel 10.x
- **Base de données**: MySQL 8.0+
- **Cache & File d'attente**: Redis
- **File d'attente**: Laravel Horizon
- **Monitoring**: Laravel Health
- **Journalisation**: Spatie Activity Log

### Frontend
- **Framework CSS**: Tailwind CSS 3.x
- **Templating**: Blade
- **Design**: Interface moderne et minimaliste
- **Responsive**: Compatible mobile et desktop
- **Animations**: Transitions fluides

### Sécurité
- Protection CSRF
- Validation des données côté serveur
- Hachage des mots de passe (bcrypt)
- Protection contre les injections SQL
- Gestion des sessions sécurisées

### Outils de Développement
- **Gestion des dépendances**: Composer
- **Versioning**: Git
- **Environnement de développement**: Laravel Sail / Docker
- **Tests**: PHPUnit

## Prérequis

- PHP 8.1+
- Composer 2.0+
- Node.js 16+
- MySQL 8.0+
- Redis 6.0+

## Installation

1. Cloner le dépôt
```bash
git clone https://github.com/votre-utilisateur/gestion-parcours-usmba.git
cd gestion-parcours-usmba
```

2. Installer les dépendances PHP
```bash
composer install
```

3. Installer les dépendances NPM
```bash
npm install
npm run build
```

4. Configurer l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

5. Configurer la base de données dans `.env`

6. Lancer les migrations et les seeders
```bash
php artisan migrate --seed
```

7. Démarrer le serveur de développement
```bash
php artisan serve
```

## Licence

Ce projet est sous licence [MIT](LICENSE).

## Auteurs

- [Badie](https://github.com/Badie005)

## Remerciements

- Équipe pédagogique de l'USMBA
- Tous les contributeurs au projet

## Prérequis

- PHP 8.1 ou plus récent
- Composer 2.0 ou plus récent
- Node.js 16 ou plus récent
## Mises à jour récentes

### Sécurité et gestion des comptes
- Ajout du changement de mot de passe obligatoire à la première connexion
- Amélioration du formulaire de changement de mot de passe dans le profil étudiant
- Enregistrement des actions de connexion et de changement de mot de passe dans l'historique
- Messages d'erreur de validation améliorés en français
- Installation de Laravel Horizon pour la gestion des files d'attente
- Installation de Laravel Health pour le monitoring de l'application
- Installation de Spatie Activity Log pour le suivi des actions

### Gestion des parcours
- Correction des problèmes de sélection des parcours avec la mise à jour des relations entre les tables
- Amélioration de l'interface de sélection des parcours avec un design plus moderne et interactif
- Vérification des prérequis académiques pour l'éligibilité aux parcours
- Ajout de la gestion des crédits validés par semestre pour la validation des parcours
- Amélioration de la validation côté serveur pour assurer l'intégrité des données
- Correction des problèmes de migration avec la colonne id_filiere
- Mise à jour des seeders pour utiliser la nomenclature correcte des champs

### Interface utilisateur
- Nouvelle barre de navigation avec effet glassmorphism (transparent et flou) fixée en haut de la page
- Ajout d'ombres portées (drop shadows) sur tous les composants principaux pour une meilleure profondeur visuelle
- Effets de transition et d'animation au survol des éléments interactifs
- Boutons redesignés en style minimaliste, moderne et compact avec animations subtiles
- Simplification de l'affichage des résultats académiques pour se concentrer sur les informations essentielles
- Ajout de boutons de navigation entre les différentes sections de l'application
- Harmonisation du design visuel avec un style cohérent sur toutes les pages
- Optimisation des espaces avec une marge supérieure appropriée pour le contenu principal
- Fond blanc pour la section "Progression de votre parcours académique" pour un contraste optimal

### Corrections techniques
- Correction des attributs de modèle Etudiant pour utiliser les noms de colonnes appropriés (num_inscription, email_academique, nom_fr, prenom_fr)
- Ajout de la colonne `password_changed` pour suivre l'état du changement de mot de passe
- Correction de la relation entre les tables en remplaçant 'filiere_id' par 'id_filiere'
- Mise à jour des seeders pour utiliser la nomenclature correcte des champs
- Résolution des erreurs 500 sur la page de sélection des parcours
- Optimisation des calculs statistiques pour les résultats académiques
- Correction des bugs d'affichage des graphiques Chart.js
- Gestion robuste des cas où les données sont manquantes
- Ajout du service AttestationPdfService pour la génération sécurisée des PDF avec QR code, hash et protection
- Mise en place du système de throttling pour les routes sensibles
- Ajout de l'endpoint de health check

## Installation pour le développement

1. Cloner le dépôt :
   ```bash
   git clone https://github.com/Badie005/gestion-parcours-usmba.git
   cd gestion-parcours-usmba
   ```

2. Installer les dépendances PHP :
   ```bash
   composer install
   ```

3. Installer les dépendances JavaScript :
   ```bash
   npm install
   ```

4. Créer le fichier d'environnement :
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. Configurer la base de données dans le fichier `.env`

6. Exécuter les migrations et seeders :
   ```bash
   php artisan migrate --seed
   ```
   
   > **Important** : Les migrations doivent être exécutées dans l'ordre suivant pour éviter les problèmes de référence :
   > 1. Migrations de base (filieres, parcours)
   > 2. Migration des étudiants
   > 3. Migration des actions historiques
   > 4. Migrations additionnelles (password_changed, etc.)
   > 5. Migration des filières et parcours

7. Compiler les assets et lancer le serveur de développement :
   ```bash
   npm run dev
   php artisan serve
   ```

## Comptes de test

Un compte étudiant de test est disponible pour l'accès initial :

- **Email** : etu1@etu.univ.ma
- **Mot de passe** : 1234

> **Note** : Lors de la première connexion, l'application invitera l'utilisateur à changer ce mot de passe par défaut, conformément aux nouvelles mesures de sécurité implémentées.

## Fonctionnalités principales

### Gestion du compte et profil étudiant
- Changement obligatoire du mot de passe à la première connexion
- Formulaire de profil pour la mise à jour des informations personnelles
- Affichage des informations académiques (filière, résultats, parcours choisi)

### Résultats académiques
- Visualisation détaillée des notes par semestre avec système d'onglets
- Statistiques de progression avec graphiques interactifs
- Section pliable pour les statistiques et graphiques
- Export PDF des résultats académiques

### Choix de parcours
- Sélection intelligente des parcours disponibles selon la filière de l'étudiant
- Vérification des prérequis académiques
- Confirmation et génération d'attestation

### Suivi des actions
- Historique détaillé des actions de l'étudiant
- Horodatage des événements importants

## Bonnes pratiques de développement

### Sécurité

- Le changement de mot de passe à la première connexion est obligatoire pour renforcer la sécurité
- Les mots de passe doivent comporter au minimum 8 caractères
- Toutes les actions importantes sont enregistrées dans l'historique (connexions, changements de mot de passe, etc.)
- Les messages d'erreur ont été traduits en français pour une meilleure compréhension par les utilisateurs

### Interface utilisateur

- Conforme aux préférences de design : style minimaliste et moderne
- Barre de navigation fixée avec effet glassmorphism pour une navigation constante
- Boutons compacts et légers avec texte coloré sur fond transparent ou très léger
- Animations subtiles et effets de transition lors des interactions
- Ombres portées sur tous les composants principaux pour une hiérarchie visuelle claire
- Espacement optimisé avec marge supérieure appropriée pour le contenu principal
- Formulaires optimisés pour une expérience utilisateur fluide
- Messages de succès et d'erreur clairement identifiables
- Éléments d'interface pliables pour optimiser l'espace
- Graphiques interactifs avec indications visuelles claires
- Navigation inter-sections facilitée par des boutons dédiés

### Structure des données

- Les noms des attributs dans le modèle Etudiant ont été corrigés pour correspondre aux colonnes de la base de données
- Un champ `password_changed` a été ajouté pour suivre l'état du changement de mot de passe
- Calculs statistiques optimisés pour éviter les erreurs de division par zéro
- Gestion des cas limites dans les données académiques

## Déploiement en production

### 1. Préparation du serveur

- Un serveur web (Apache, Nginx) avec PHP 8.1+ installé
- Modules PHP requis : BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML
- Une base de données (MySQL, PostgreSQL)
- Composer installé globalement
- Node.js et npm pour la compilation des assets

### 2. Configuration du projet pour la production

1. Cloner le dépôt sur le serveur :
   ```bash
   git clone https://github.com/Badie005/gestion-parcours-usmba.git /var/www/gestion-parcours-usmba
   cd /var/www/gestion-parcours-usmba
   ```

2. Installer les dépendances en mode production :
   ```bash
   composer install --no-dev --optimize-autoloader
   npm install
   ```

3. Configurer l'environnement de production :
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Éditer le fichier `.env` pour la production :
   ```
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://gestion-parcours-usmba.com 
   //pas de domaine pour le moment
   
   # Configuration de la base de données de production
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=gestion_parcours_usmba
   DB_USERNAME=username
   DB_PASSWORD=password
   ```

5. Exécuter les migrations :
   ```bash
   php artisan migrate --force
   ```

6. Peupler la base de données avec les données initiales :
   ```bash
   php artisan db:seed
   ```

### 3. Optimisation pour la production

Pour optimiser l'application pour la production, exécutez le script d'optimisation :

```bash
./optimize.bat   # Pour Windows
```

Ou lancez manuellement les commandes suivantes :

```bash
# Mise en cache des configurations et routes
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Compilation et minification des assets
npm run build
```

### 4. Configuration du serveur web

#### Pour Nginx :

```nginx
server {
    listen 80;
    server_name gestion-parcours-usmba.com;
    root /var/www/gestion-parcours-usmba/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

#### Pour Apache (.htaccess est déjà inclus dans le projet)

Assurez-vous que le module `mod_rewrite` est activé sur votre serveur Apache.

### 5. Sécurité en production

1. Ajustez les permissions des fichiers :
   ```bash
   chmod -R 755 /var/www/gestion-parcours-usmba
   chmod -R 777 /var/www/gestion-parcours-usmba/storage
   chmod -R 777 /var/www/gestion-parcours-usmba/bootstrap/cache
   ```

2. Assurez-vous que vos certificats SSL sont correctement configurés pour utiliser HTTPS.

3. Configurez une tâche CRON pour les tâches planifiées Laravel :
   ```
   * * * * * cd /var/www/gestion-parcours-etudiants && php artisan schedule:run >> /dev/null 2>&1
   ```

### 6. Maintenance et mises à jour

Pour mettre à jour l'application sans temps d'arrêt :

1. Activez le mode maintenance :
   ```bash
   php artisan down
   ```

2. Mettez à jour le code depuis le dépôt :
   ```bash
   git pull origin main
   ```

3. Mettez à jour les dépendances et recompilez les assets :
   ```bash
   composer install --no-dev --optimize-autoloader
   npm install
   npm run build
   ```

4. Exécutez les migrations si nécessaire :
   ```bash
   php artisan migrate --force
   ```

5. Optimisez l'application :
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

6. Désactivez le mode maintenance :
   ```bash
   php artisan up
   ```

## Comptes de test

L'application est fournie avec des comptes de test pour faciliter la démonstration :

- **Email**: etudiant1@example.com, **Mot de passe**: password
- **Email**: etudiant2@example.com, **Mot de passe**: password

## Développement et tests

L'application inclut une suite de tests fonctionnels pour vérifier les principales fonctionnalités :

```bash
php artisan test
```

## Licence

Cette application est fournie sous licence XXXX.
