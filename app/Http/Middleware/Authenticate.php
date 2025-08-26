<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    
}
 foreach ($guards as $guard) {
    if (Auth::guard($guard)->check()) {
        if ($guard === 'admin') {
            return redirect('/admin/login');
        }
        return redirect(RouteServiceProvider::HOME);
    }
}
