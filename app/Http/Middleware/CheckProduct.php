<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProduct
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $check_user_order = auth()->user()->orders()->latest()->first();
        if (!$check_user_order && $check_user_order?->user_id != auth()->user()->id) return to_route('subscriptions');
        return $next($request);
    }
}
