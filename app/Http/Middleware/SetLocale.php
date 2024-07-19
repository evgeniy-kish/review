<?php

namespace App\Http\Middleware;

use App;
use Closure;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Cookie;

class SetLocale
{
    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$lang = $request->cookie('lang')) {
            return $this->setNewLocale($request, $next);
        }

        return $this->setLocale($lang, $next, $request);
    }

    /**
     * @param Request $request
     * @param Closure(Request): Response $next
     *
     * @return Response
     */
    protected function setNewLocale(Request $request, Closure $next)
    {
        $lang = Language::resolve(substr($request->header('accept_language') ?? 'ru', 0, 2));
        App::setLocale($lang);

        $response = $next($request);

        return $response->withCookie(new Cookie('lang', $lang, 0x7FFFFFFF));
    }

    /**
     * @param string  $lang
     * @param Closure $next
     * @param Request $request
     *
     * @return mixed
     */
    protected function setLocale(string $lang, Closure $next, Request $request)
    {
        App::setLocale($lang === 'ru' ? 'ru' : 'en');

        return $next($request);
    }
}
