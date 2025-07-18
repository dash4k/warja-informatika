import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    server: {
        host: '0.0.0.0',
        strictPort: true,
        hmr: {
            host: '192.168.1.20',
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/register.js',
                'resources/js/portofolio.js',
                'resources/js/adminSoal.js',
                'resources/js/transkrip.js',
                'resources/js/adminBiodata.js',
                'resources/js/navbar-dashboard.js',
                'resources/js/adminPortofolio.js',
                'resources/js/login.js',
                'resources/js/sidebar.js',
                'resources/js/biodata.js',
                'resources/js/adminUjian.js',
                'resources/js/dashboard.js',
                'resources/js/adminNilai.js',
                'resources/js/bootstrap.js',
                'resources/js/adminValidatedPortofolio.js',
                'resources/js/adminPenjaluran.js',
                'resources/js/Alert.js',
                'resources/js/navbar.js',
                'resources/js/penjaluranExam.js',
                'resources/js/ujianCountdown.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
