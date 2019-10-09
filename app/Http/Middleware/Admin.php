<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        if($user != null) {
            if ($user->role != 'admin') {
                return abort(404);
            }
        }  else {
            return abort(404);
        }
        return $next($request);
    }
}
