<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 🌍 Laravel CORS Configuration (Final & Optimized for Railway)
    |--------------------------------------------------------------------------
    |
    | Pengaturan ini memastikan semua route API, Sanctum, dan proxy
    | bisa diakses lintas domain (misal dari file HTML, frontend Netlify,
    | atau proyek Laravel lain).
    |
    | Sudah mendukung: GET, POST, PUT, PATCH, DELETE, OPTIONS
    | dan aman dari error preflight.
    |
    */

    // ✅ Semua endpoint API, Sanctum, dan proxy
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'proxy/*'],

    // ✅ Izinkan semua metode HTTP
    'allowed_methods' => ['*'],

    // ✅ Izinkan semua domain (bisa kamu ganti jika mau lebih aman)
    'allowed_origins' => ['*'],

    // (Opsional) jika kamu mau batasi domain tertentu:
    // 'allowed_origins' => [
    //     'https://projekkelompok9-production.up.railway.app',
    //     'https://projek5-production.up.railway.app',
    //     'https://sobatpromo-api-production.up.railway.app'
    // ],

    // ✅ Pola wildcard tambahan
    'allowed_origins_patterns' => [],

    // ✅ Semua header diizinkan (penting untuk FormData dan JSON)
    'allowed_headers' => ['*'],

    // ✅ Header tambahan yang boleh dilihat oleh client (mis. X-Custom)
    'exposed_headers' => ['Authorization', 'X-Requested-With', 'Content-Type'],

    // ✅ Cache preflight selama 1 jam (biar lebih cepat)
    'max_age' => 3600,

    // ✅ Dukungan credentials (kalau pakai cookie / token Sanctum)
    'supports_credentials' => true,

];
