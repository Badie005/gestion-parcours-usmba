@echo off
echo Optimisation de l'application pour la production...

echo Effacement des caches existants...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo Mise en cache de la configuration...
php artisan config:cache

echo Mise en cache des routes...
php artisan route:cache

echo Mise en cache des vues...
php artisan view:cache

echo Compilation des assets avec npm...
npm run build

echo Optimisation terminée avec succès!
