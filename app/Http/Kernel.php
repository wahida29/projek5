<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * 🌍 Daftar middleware global aplikasi.
     * Middleware ini dijalankan di setiap request — termasuk API & Web.
     */
    protected $middleware = [
        // 🔒 Atur proxy & header
        \App\Http\Middleware\TrustProxies::class,

        // 🌐 Aktifkan CORS global (cukup satu kali di sini)
        \Illuminate\Http\Middleware\HandleCors::class, // ✅ Versi Laravel 10+ (ganti Fruitcake)

        // 🚧 Maintenance & batasan ukuran request
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,

        // ✨ Membersihkan input
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * 🚀 Kelompok middleware untuk rute Web & API.
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // ⚡ Batasi request agar aman (rate limit)
            \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',

            // 🔗 Pastikan route binding tetap jalan
            \Illuminate\Routing\Middleware\SubstituteBindings::class,

            // ⚙️ CORS jangan ditambah di sini (sudah aktif global di atas)
        ],
    ];

    /**
     * 🧩 Middleware rute individual.
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
