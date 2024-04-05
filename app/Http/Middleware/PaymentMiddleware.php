<?php

namespace App\Http\Middleware;

use App\Models\Transaction;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Symfony\Component\HttpFoundation\Response;

class PaymentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $check_order = auth()->user()->orders()->latest()->first();
        if (!is_null($check_order) && $check_order->status_work == 'working') {
            if (Date::now() <= $check_order->end_date) return abort(404);
        }
        return $next($request);
    }
}
