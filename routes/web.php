<?php

use App\Http\Middleware\EnsureTwoFactorConfigured;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route(auth()->check() ? 'dashboard' : 'login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/setup-otp', function () {
        $user = auth()->user();

        if ($user->two_factor_secret && $user->two_factor_confirmed_at) {
            return redirect()->route('dashboard');
        }

        return view('auth.setup-otp');
    })->name('otp.setup');

    Route::middleware(EnsureTwoFactorConfigured::class)->group(function () {

        Route::get('/dashboard', function () {
            return response()
                ->view('dashboard')
                ->header('Cache-Control', 'no-store, private');
        })->name('dashboard');

        Route::get('/lab/status', function () {
            $hostname = strtolower(gethostname() ?: 'desconocido');

            $page = str_contains($hostname, 'rocky03')
                ? 1
                : (str_contains($hostname, 'rocky04') ? 2 : 0);

            return response()->json([
                'page' => $page,
                'hostname' => $hostname,
                'checked_at' => now()->toIso8601String(),
            ])->header('Cache-Control', 'no-store, private');

        })->name('lab.status');
    });
});
