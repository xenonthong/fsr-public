<?php

namespace App\Http\Middleware;

use App\Enums\VerificationStatus;
use Closure;
use Illuminate\Support\Facades\Auth;

class Verifiable
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

        switch ($status) {
            case (string) VerificationStatus::VERIFIED():
                return response()->json('You have been verified', 403);
                break;
            case (string) VerificationStatus::PENDING():
                return response()->json('You have a pending verification', 403);
                break;
        }

        return $next($request);
    }
}
