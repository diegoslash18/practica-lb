<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorConfigured
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (
            ! $user ||
            empty($user->two_factor_secret) ||
            is_null($user->two_factor_confirmed_at)
        ) {
            return redirect()
                ->route('otp.setup')
                ->with('two_factor_required', true);
        }

        return $next($request);
    }
}
