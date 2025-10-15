<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 🌍 Laravel CORS Configuration (Final Version for Full CRUD)
    |--------------------------------------------------------------------------
    |
    | File ini mengatur Cross-Origin Resource Sharing (CORS) agar API Laravel
    | bisa diakses dari domain lain (misalnya dashboard kolaborasi, Railway,
    | Netlify, atau frontend HTML/JS biasa). Konfigurasi ini sangat fleksibel
    | dan stabil untuk deployment lintas platform.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Jalur endpoint yang diperbolehkan CORS
    |--------------------------------------------------------------------------
    | Semua route API, termasuk sanctum/csrf-cookie, diizinkan untuk lintas domain.
    */
    'paths' => ['api/*', 'proxy/*', 'sanctum/csrf-cookie'],

    /*
    |--------------------------------------------------------------------------
    | Metode HTTP yang diizinkan
    |--------------------------------------------------------------------------
    | Gunakan '*' agar seluruh operasi CRUD dapat berjalan tanpa batasan.
    */
    'allowed_methods' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Asal domain (origin) yang diizinkan
    |--------------------------------------------------------------------------
    | '*' artinya semua domain diizinkan (localhost, Railway, Netlify, Vercel, dll).
    | Jika ingin membatasi, ubah misalnya menjadi ['https://yourdomain.com'].
    */
    'allowed_origins' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Pola domain tambahan (optional)
    |--------------------------------------------------------------------------
    | Jika kamu pakai wildcard domain seperti *.railway.app, bisa ditambahkan di sini.
    */
    'allowed_origins_patterns' => [],

    /*
    |--------------------------------------------------------------------------
    | Header yang boleh dikirim oleh client
    |--------------------------------------------------------------------------
    | '*' memperbolehkan semua header custom, termasuk Authorization, Content-Type, dll.
    */
    'allowed_headers' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Header yang boleh diakses client dari response server
    |--------------------------------------------------------------------------
    | Misalnya: ['Authorization', 'X-Custom-Header']
    */
    'exposed_headers' => ['Authorization', 'Content-Type', 'X-Requested-With'],

    /*
    |--------------------------------------------------------------------------
    | Lama cache preflight request
    |--------------------------------------------------------------------------
    | Preflight OPTIONS akan disimpan di browser selama 1 jam (3600 detik)
    */
    'max_age' => 3600,

    /*
    |--------------------------------------------------------------------------
    | Apakah mengizinkan credential lintas domain
    |--------------------------------------------------------------------------
    | Jika frontend kamu perlu mengirim cookie / token auth, ubah ke true.
    | Default: false (aman untuk API publik).
    */
    'supports_credentials' => false,
];
