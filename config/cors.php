<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 🌍 Laravel CORS Configuration (Final & Optimized for Full CRUD + Railway)
    |--------------------------------------------------------------------------
    |
    | Konfigurasi ini memastikan semua route API dan proxy kamu bisa diakses
    | lintas domain (misal dari file HTML, proyek Laravel lain, atau frontend
    | yang dihosting di Railway/Netlify/Vercel).
    |
    | Konfigurasi ini kompatibel untuk request GET, POST, PUT, PATCH, DELETE
    | dan sudah aman dari error preflight (OPTIONS).
    |
    */

    // ✅ Semua endpoint API, sanctum, dan proxy
    'paths' => ['api/*', 'proxy/*', 'sanctum/csrf-cookie'],

    // ✅ Izinkan semua metode HTTP (GET, POST, PUT, PATCH, DELETE, OPTIONS)
    'allowed_methods' => ['*'],

    // ✅ Izinkan semua domain (localhost, Railway, Netlify, Vercel, dll)
    'allowed_origins' => ['*'],

    // (Opsional) Pola wildcard domain tambahan
    'allowed_origins_patterns' => [],

    // ✅ Izinkan semua header (termasuk Authorization, Content-Type)
    'allowed_headers' => ['*'],

    // ✅ Header yang dapat diakses oleh frontend
    'exposed_headers' => ['Authorization', 'Content-Type', 'X-Requested-With'],

    // ✅ Cache preflight selama 1 jam
    'max_age' => 3600,

    // ⚠️ Jangan aktifkan credential kecuali pakai cookie/session
    'supports_credentials' => false,
];
