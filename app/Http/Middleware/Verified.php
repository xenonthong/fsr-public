<?php

namespace App\Http\Middleware;

use App\Enums\VerificationStatus;
use Closure;
use Illuminate\Support\Facades\Auth;

class Verified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $status = $request->user()->verification_status;

        if ($status !== (string) VerificationStatus::VERIFIED()) {
            return response()->json('User is unverified.', 403);
        }

        return $next($request);
    }
}
