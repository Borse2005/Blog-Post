<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LocalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $local = null;

        if (Auth::check() && !Session::has('locale')) {
            $local = $request->user()->locale;
            Session::put('locale', $local);
        }

        if ($request->has('locale')) {
            $local = $request->get('locale');
            Session::put('locale', $local);
        }

        $local = Session::get('locale');

        if (null === $local) {
            $locale = config('app.faker_locale');
        }

        App::setLocale($local);



        return $next($request);
    }
}
