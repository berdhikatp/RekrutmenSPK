<?php

namespace App\Http\Middleware;

use Closure;

class AuthMahasiswa
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
        $user = auth()->user();

        if(!$user->isMahasiswa()){
            return redirect()->back();
        }

        return $next($request);
    }
}
