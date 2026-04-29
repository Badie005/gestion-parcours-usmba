# Rapport d'Audit & Métriques - Gestion des Parcours Étudiants (USMBA)
*Auditeur / DevOps : B.DEV*

## 1. Stack Technique Confirmée
L'analyse de la configuration du projet (`composer.json`, `package.json`, `docker-compose.yml`) valide l'utilisation de la stack suivante :
- **Backend :** Laravel 12.16.0, PHP 8.3 (compatible 8.2+), MySQL 8.0, Laravel Sanctum 4.1
- **Frontend :** Tailwind CSS 3.1, Alpine.js 3.4, Blade, Vite 6.3

## 2. Test de Charge & Performance (Benchmark k6)
Un test de stress a été réalisé en environnement local simulé avec k6 (jusqu'à 50 utilisateurs virtuels simultanés en rampe sur la page d'accueil).
- **Requêtes par seconde (RPS) max :** ~74 RPS
- **Temps de réponse moyen :** ~36.4 ms
- **Temps de réponse p(95) :** ~96 ms
- **Taux d'erreur :** 0% d'échec de requêtes HTTP
- **Conclusion :** Le serveur gère de manière stable 50+ utilisateurs simultanés en maintenant le temps de réponse très largement inférieur à la limite stricte de 500 ms (p95 à ~96 ms). Cette métrique remplace solidement l'estimation "Users 500+".

## 3. Audit de Sécurité
Les audits des dépendances (`composer audit` et `npm audit`) ont mis en évidence l'architecture de base, mais ont également soulevé certains points pour atteindre véritablement la note **'A+'** :
- **Constatations :** L'authentification repose sur Laravel Sanctum.
- **Pour valider un "A+" :** Il est nécessaire d'exécuter `npm audit fix` et `composer update` pour corriger les vulnérabilités de dépendances existantes (notamment `form-data` et `phpunit`). Côté applicatif, il est recommandé de renforcer les headers de sécurité (ex: HSTS, CSP) et d'ajouter la directive `SESSION_SECURE_COOKIE=true` dans les environnements de production pour forcer les attributs *Secure* et *SameSite*.

## 4. Analyse de Haute Disponibilité (HA)
L'analyse des scripts de déploiement (`render.yaml` et `optimize.bat`) montre une excellente préparation pour la mise en cache de la production (routes, vues, config).
- **Justification "Production-Ready" :** "L'application est structurée pour la production grâce à des scripts de mise en cache stricts (`optimize.bat`) et une configuration d'environnement désactivant les modes de debug, mais pour garantir un Uptime de 99.8% à grande échelle, il sera nécessaire de remplacer le serveur natif (`php artisan serve`) par Nginx/PHP-FPM, et de migrer les sessions et le cache vers un système distribué tel que Redis."
