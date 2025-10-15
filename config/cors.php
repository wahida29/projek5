<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 🌍 Laravel CORS Configuration (Full CRUD + Proxy Safe)
    |--------------------------------------------------------------------------
    |
    | Konfigurasi ini memastikan semua request lintas domain (frontend → backend)
    | dapat berjalan tanpa error CORS — termasuk saat pakai fetch(), axios,
    | Postman, Railway, Netlify, Vercel, dan localhost.
    |
    */

    // ✅ Semua endpoint API dan proxy diizinkan lintas domain
    'paths' => [
        'api/*',
        'proxy/*',
        'sanctum/csrf-cookie',
        '*', // tambahan agar semua route termasuk /crud bisa akses bebas
    ],

    // ✅ Izinkan semua metode HTTP (CRUD + OPTIONS)
    'allowed_methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],

    // ✅ Izinkan semua origin (domain mana pun)
    'allowed_origins' => ['*'],

    // ✅ Jika perlu domain spesifik, tambahkan di sini:
    // 'allowed_origins' => ['http://localhost:8000', 'https://projek5-production.up.railway.app'],

    'allowed_origins_patterns' => [],

    // ✅ Semua header diperbolehkan
    'allowed_headers' => ['*'],

    // ✅ Header yang boleh dibaca oleh frontend
    'exposed_headers' => ['Authorization', 'Content-Type', 'X-Requested-With'],

    // ✅ Cache preflight selama 1 jam
    'max_age' => 3600,

    // ✅ Credential (set true hanya jika pakai login berbasis cookie)
    'supports_credentials' => false,
];
