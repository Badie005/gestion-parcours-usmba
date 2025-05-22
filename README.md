# Gestion des Parcours Étudiants - USMBA

<p align="center">
  <img src="public/images/logo.png" alt="Logo Gestion Parcours Étudiants" width="200" />
</p>

## À propos de l'application

Cette application web permet la gestion des parcours étudiants au sein de l'Université Sidi Mohamed Ben Abdellah (USMBA). Elle offre les fonctionnalités suivantes :

- Authentification sécurisée des étudiants via email académique
- Tableau de bord personnalisé avec suivi de l'état du profil et choix de parcours
- Consultation des filières et parcours disponibles selon le profil étudiant
- Sélection et confirmation d'un parcours selon la filière et les résultats académiques
- Génération de PDF de confirmation de choix de parcours avec informations complètes
- Historique des actions pour suivre les étapes importantes du parcours
- Interface utilisateur moderne et responsive avec Tailwind CSS

## Technologies utilisées

- **Backend**: Laravel 10.x
- **Frontend**: Blade + Tailwind CSS
- **Base de données**: MySQL
- **Authentification**: Laravel Breeze
- **PDF**: Barryvdh/DomPDF

## Prérequis

- PHP 8.1 ou plus récent
- Composer 2.0 ou plus récent
- Node.js 16 ou plus récent
- npm 8 ou plus récent
- Serveur de base de données MySQL 5.7+ ou MariaDB 10.2+

## Installation pour le développement

1. Cloner le dépôt :
   ```bash
   git clone https://votre-repo/gestion-parcours-etudiants.git
   cd gestion-parcours-etudiants
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

7. Compiler les assets et lancer le serveur de développement :
   ```bash
   npm run dev
   php artisan serve
   ```

## Déploiement en production

### 1. Préparation du serveur

- Un serveur web (Apache, Nginx) avec PHP 8.1+ installé
- Modules PHP requis : BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML
- Une base de données (MySQL, PostgreSQL, SQLite)
- Composer installé globalement
- Node.js et npm pour la compilation des assets

### 2. Configuration du projet pour la production

1. Cloner le dépôt sur le serveur :
   ```bash
   git clone https://votre-repo/gestion-parcours-etudiants.git /var/www/gestion-parcours-etudiants
   cd /var/www/gestion-parcours-etudiants
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
   APP_URL=https://votre-domaine.com
   
   # Configuration de la base de données de production
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=gestion_parcours
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
    server_name votre-domaine.com;
    root /var/www/gestion-parcours-etudiants/public;

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
   chmod -R 755 /var/www/gestion-parcours-etudiants
   chmod -R 777 /var/www/gestion-parcours-etudiants/storage
   chmod -R 777 /var/www/gestion-parcours-etudiants/bootstrap/cache
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

Cette application est fournie sous licence MIT.
