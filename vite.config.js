import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        // Configuration pour la production
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,  // Supprime les console.log en production
                drop_debugger: true  // Supprime les instructions debugger
            },
            output: {
                comments: false      // Supprime les commentaires
            }
        },
        // Génère des assets avec hash pour l'invalidation du cache
        rollupOptions: {
            output: {
                manualChunks: {  // Sépare les dépendances en chunks pour un meilleur caching
                    vendor: ['alpinejs', 'axios']
                },
                entryFileNames: 'assets/[name].[hash].js',
                chunkFileNames: 'assets/[name].[hash].js',
                assetFileNames: 'assets/[name].[hash].[ext]'
            }
        }
    }
});
