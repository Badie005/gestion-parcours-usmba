# Gestion des Parcours Étudiants - USMBA

<p align="center">
  <img src="public/logo.png" alt="Logo Gestion Parcours Étudiants" width="200" />
</p>

[![License: Academic](https://img.shields.io/badge/License-Academic%20Project-blue.svg)](LICENSE)
[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?logo=laravel)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?logo=php)](https://php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?logo=mysql)](https://mysql.com/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-3.x-38B2AC?logo=tailwind-css)](https://tailwindcss.com/)

---

## Présentation

Application web complète pour la **gestion des parcours universitaires** à l'Université Sidi Mohamed Ben Abdellah (USMBA). Développée dans le cadre d'un **stage BTS MCW** à la Faculté Polydisciplinaire de Taza (FPT).

Cette solution offre une plateforme sécurisée et intuitive pour :
- La gestion des inscriptions étudiantes
- Le suivi académique et des résultats
- L'orientation et le choix des parcours

> **Type de projet** : Stage académique (BTS MCW)

---

## Fonctionnalités principales

| Module | Fonctionnalités |
|--------|-----------------|
| **Authentification** | Connexion sécurisée, changement de mot de passe obligatoire, sessions sécurisées |
| **Gestion du profil** | Consultation et modification des informations personnelles |
| **Résultats académiques** | Visualisation des notes, moyennes et progression |
| **Choix de parcours** | Sélection et validation des parcours universitaires |
| **Suivi des actions** | Historique complet des activités |
| **Administration** | Gestion des étudiants, parcours et configurations |

---

## Stack Technique

### Backend

| Technologie | Version | Usage |
|-------------|---------|-------|
| **Laravel** | 12.x | Framework PHP |
| **PHP** | 8.1+ | Langage serveur |
| **MySQL** | 8.0+ | Base de données |
| **Redis** | 6.0+ | Cache et file d'attente |
| **Laravel Sanctum** | - | Authentification API |
| **Laravel Horizon** | - | Gestion des queues |
| **DomPDF** | - | Génération de PDF |

### Frontend

| Technologie | Version | Usage |
|-------------|---------|-------|
| **Blade** | - | Templating |
| **Tailwind CSS** | 3.x | Framework CSS |
| **Alpine.js** | - | Interactivité |
| **Laravel Mix** | - | Build assets |

### Sécurité

- Protection CSRF et XSS
- Hachage des mots de passe (bcrypt)
- Validation des données côté serveur
- Protection contre les injections SQL
- Rate limiting sur les routes sensibles
- Sessions sécurisées

---

## Prérequis

| Outil | Version |
|-------|---------|
| PHP | >= 8.1 |
| Composer | >= 2.0 |
| Node.js | >= 16 |
| MySQL | >= 8.0 |
| Redis | >= 6.0 |

---

## Installation

```bash
# 1. Cloner le dépôt
git clone https://github.com/Badie005/gestion-parcours-usmba.git
cd gestion-parcours-usmba

# 2. Installer les dépendances PHP
composer install

# 3. Installer les dépendances NPM
npm install
npm run build

# 4. Configurer l'environnement
cp .env.example .env
php artisan key:generate

# 5. Configurer la base de données dans .env
# DB_DATABASE=gestion_parcours
# DB_USERNAME=votre_utilisateur
# DB_PASSWORD=votre_mot_de_passe

# 6. Lancer les migrations et seeders
php artisan migrate --seed

# 7. Démarrer le serveur
php artisan serve
```

Accédez à l'application : [http://localhost:8000](http://localhost:8000)

---

## Variables d'environnement

```env
APP_NAME="Gestion Parcours USMBA"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_parcours
DB_USERNAME=root
DB_PASSWORD=

REDIS_HOST=127.0.0.1
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
```

---

## Structure du projet

```
gestion-parcours-usmba/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Logique des endpoints
│   │   └── Middleware/      # Auth, validation
│   ├── Models/              # Modèles Eloquent
│   └── Services/            # Logique métier
├── config/                  # Configuration Laravel
├── database/
│   ├── migrations/          # Structure de la BDD
│   └── seeders/             # Données de test
├── public/                  # Assets publics
├── resources/
│   ├── views/               # Templates Blade
│   └── css/                 # Styles Tailwind
├── routes/
│   └── web.php              # Routes de l'application
└── tests/                   # Tests PHPUnit
```

---

## Comptes de test

| Rôle | Email | Mot de passe |
|------|-------|--------------|
| **Admin** | admin@usmba.ac.ma | password |
| **Étudiant** | etudiant@usmba.ac.ma | password |

> Note : Changement de mot de passe obligatoire à la première connexion

---

## Scripts disponibles

| Commande | Description |
|----------|-------------|
| `php artisan serve` | Serveur de développement |
| `npm run dev` | Build assets (développement) |
| `npm run build` | Build assets (production) |
| `php artisan test` | Lancer les tests |
| `php artisan migrate:fresh --seed` | Réinitialiser la BDD |

---

## Mises à jour récentes

### Interface & Layout (Juin 2025)
- Interface moderne avec effets glassmorphism
- Design minimaliste avec boutons compacts
- Responsive mobile et desktop

### Sécurité & Déploiement (Décembre 2024)
- Changement de mot de passe obligatoire
- Rate limiting sur routes sensibles
- Optimisations de performance

---

## Licence

Ce projet est sous **licence académique personnalisée**.

- Consultation et fork autorisés pour usage éducatif
- Usage commercial interdit sans autorisation
- Voir le fichier [LICENSE](LICENSE) pour plus de détails

---

## Auteur

**Abdelbadie Khoubiza**

| Plateforme | Lien |
|------------|------|
| GitHub | [@Badie005](https://github.com/Badie005) |
| Email | [a.khoubiza.dev@gmail.com](mailto:a.khoubiza.dev@gmail.com) |
| Portfolio | [portfoliobadie.vercel.app](https://portfoliobadie.vercel.app) |
| LinkedIn | [Badie Khoubiza](https://www.linkedin.com/in/badie-khoubiza) |

---

## Remerciements

- Équipe pédagogique de l'USMBA
- Faculté Polydisciplinaire de Taza (FPT)
- Tous les contributeurs au projet

---

Copyright © 2025 Abdelbadie Khoubiza - Tous droits réservés
