import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/spa.css',
                'resources/js/app.js',
                'resources/js/spa.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        // Enable CSS code splitting
        cssCodeSplit: true,
        // Use esbuild for minification (bundled with Vite, faster than terser)
        minify: 'esbuild',
        esbuild: {
            drop: ['console', 'debugger'],
        },
        // Chunk splitting for better caching
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        return 'vendor';
                    }
                },
            },
        },
    },
});
