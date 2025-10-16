<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 🌍 Laravel CORS Configuration (Final & Optimized for Railway)
    |--------------------------------------------------------------------------
    |
    | Pengaturan ini memastikan semua route API, Sanctum, dan proxy bisa diakses
    | lintas domain (misal dari HTML, frontend React/Vue, Netlify, atau proyek
    | Laravel lain).
    |
    | ✅ Mendukung semua metode HTTP (GET, POST, PUT, PATCH, DELETE, OPTIONS)
    | ✅ Sudah aman dari error preflight
    | ✅ Kompatibel dengan Railway, localhost, dan domain publik
    |
    */

    // Semua endpoint API, Sanctum, dan proxy
    'paths' => [
        'api/*',
        'sanctum/csrf-cookie',
        'proxy/*'
    ],

    // Izinkan semua metode HTTP (wajib untuk CRUD lengkap)
    'allowed_methods' => ['*'],

    // Izinkan semua domain (bisa diganti domain tertentu untuk keamanan)
    'allowed_origins' => ['*'],

    // (Opsional) Contoh batasi domain tertentu:
    // 'allowed_origins' => [
    //     'https://projek5-production.up.railway.app',
    //     'https://sobatpromo-api-production.up.railway.app'
    // ],

    // Pola wildcard tambahan (biarkan kosong kecuali perlu)
    'allowed_origins_patterns' => [],

    // Semua header diizinkan (penting untuk FormData dan JSON)
    'allowed_headers' => ['*'],

    // Header yang dapat diakses client (opsional tapi bagus untuk debug)
    'exposed_headers' => [
        'Authorization',
        'X-Requested-With',
        'Content-Type',
        'X-CSRF-TOKEN'
    ],

    // Cache preflight selama 1 jam (3600 detik)
    'max_age' => 3600,

    // Aktifkan credentials (untuk session, cookie, atau token Sanctum)
    'supports_credentials' => true,
];
