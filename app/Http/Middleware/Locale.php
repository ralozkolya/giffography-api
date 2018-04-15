<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Locale
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
        $locale = $this->getLocale($request->segment(1));
        App::setLocale($this->getLocale($locale));
        Session::put('locale', $locale);
        return $next($request);
    }

    private function getLocale($locale) {
        if (in_array($locale, ['ka', 'en'], true)) {
            return $locale;
        }

        if (Session::has('locale')) {
            return Session::get('locale');
        }

        return config('app.fallback_locale');
    }
}
