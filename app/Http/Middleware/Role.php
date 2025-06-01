<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  $user_roles
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $user_roles)
    {
        //dd($user_roles);
        $auth_user = Auth::user();
        if (Auth::check()) {
            return $next($request);
            
            $roles = explode(' ', $user_roles);
            if (in_array($auth_user->accountCategory->code, $roles)) {
                return $next($request);
            }

            abort(403, 'Unauthorized Request');
        } else {
            return redirect('/');
        }
    }
}
