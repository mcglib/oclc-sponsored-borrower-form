<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateViaSaml
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
        $samlAuth = $request->session()->get('saml2Auth');
        if (!is_null($samlAuth) && $samlAuth->isAuthenticated())
        {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
