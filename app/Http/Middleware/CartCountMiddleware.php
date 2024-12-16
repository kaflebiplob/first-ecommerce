<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CartCountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cartCount = 0;

        if (Auth::check()) {
            $userId = Auth::user()->id;
            $cartCount = Cart::where('user_id', $userId)->sum('quantity');
        }

        // Share cart count with all views
        view()->share('cartCount', $cartCount);
        return $next($request);
    }
}
