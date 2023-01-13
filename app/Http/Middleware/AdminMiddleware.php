<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if (Auth::check() && Auth::user()->is_admin) { // если пользователь авторизован и он администратор тогда мы передаем запрос дальше
            return $next($request);
        }
        abort(404); // выбрасываем 404 ошибку
    }
}
