<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS Configuration (Perbaikan)
    |--------------------------------------------------------------------------
    |
    | Pengaturan ini memastikan API kamu bisa diakses dari domain lain seperti
    | dashboard kolaborasi atau localhost tanpa error "CORS policy" lagi.
    |
    */

    // Path yang diizinkan untuk CORS (semua endpoint API)
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Izinkan semua method HTTP (GET, POST, PUT, PATCH, DELETE, OPTIONS)
    'allowed_methods' => ['*'],

    // Izinkan semua domain (Railway, localhost, dsb)
    'allowed_origins' => ['*'],

    // Pola domain tambahan (tidak wajib)
    'allowed_origins_patterns' => [],

    // Header yang diizinkan dikirim dari frontend
    'allowed_headers' => ['Content-Type', 'X-Requested-With', 'Authorization', 'Accept', 'Origin'],

    // Header yang boleh dilihat oleh client
    'exposed_headers' => ['Authorization', 'Content-Type'],

    // Cache preflight result (OPTIONS) selama 1 jam (3600 detik)
    'max_age' => 3600,

    // Credential (cookie, session) dimatikan agar tidak error cross-domain
    'supports_credentials' => false,

];
