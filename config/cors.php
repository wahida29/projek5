<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS Configuration (Final)
    |--------------------------------------------------------------------------
    |
    | Pengaturan ini memastikan API Laravel kamu dapat diakses lintas domain
    | (misalnya dari dashboard kolaborasi, frontend React/Vue, atau file HTML).
    | Konfigurasi ini sangat fleksibel untuk environment Railway.
    |
    */

    // Izinkan semua endpoint API dan route sanctum
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Izinkan semua metode HTTP
    'allowed_methods' => ['*'],

    // Izinkan semua asal domain (localhost, Railway, Netlify, dll)
    'allowed_origins' => ['*'],

    // Pola domain tambahan (tidak wajib, bisa dikosongkan)
    'allowed_origins_patterns' => [],

    // Header yang diizinkan dikirim dari client
    'allowed_headers' => ['*'],

    // Header yang bisa dilihat oleh client
    'exposed_headers' => [],

    // Simpan hasil preflight (OPTIONS) selama 1 jam
    'max_age' => 3600,

    // Nonaktifkan credential (karena tidak perlu cookie lintas domain)
    'supports_credentials' => false,
];
