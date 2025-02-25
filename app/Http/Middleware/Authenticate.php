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
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // 👇 Check if request is for 'admin' guard
            if ($request->is('admin/*')) {
                return route('admin.login');
            }
    
            // 👇 Default redirection for user
            return route('user.login');
        }
    }
}
