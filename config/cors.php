<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS Configuration
    |--------------------------------------------------------------------------
    |
    | File ini mengatur siapa saja dan method HTTP apa saja yang boleh
    | mengakses API kamu dari luar domain (misalnya dari dashboard kolaborasi).
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Izinkan semua method (GET, POST, PUT, DELETE, PATCH, OPTIONS)
    'allowed_methods' => ['*'],

    // Izinkan semua domain untuk akses (dashboard, Railway, localhost, dll)
    'allowed_origins' => ['*'],

    // Jika kamu ingin lebih aman, kamu bisa ganti jadi spesifik, misal:
    // 'allowed_origins' => ['https://projek5-production.up.railway.app'],

    'allowed_origins_patterns' => [],

    // Izinkan semua header
    'allowed_headers' => ['*'],

    // Header yang boleh dibaca oleh client
    'exposed_headers' => ['Authorization', 'Content-Type'],

    // Simpan preflight result (OPTIONS) selama 1 jam
    'max_age' => 3600,

    // Jangan pakai credential (true bisa bikin error kalau cross-domain)
    'supports_credentials' => false,

];
