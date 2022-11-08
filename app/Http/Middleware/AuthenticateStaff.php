<?php
namespace App\Http\Middleware;

use Auth;
use Closure;

class AuthenticateStaff
{
    public function handle($request, Closure $next)
    {
        //If request does not comes from logged in employer
        //then he shall be redirected to employer Login page
        if (!Auth::guard('staff')->check()) {
            return redirect('/login');
        }
        return $next($request);
    }
}
