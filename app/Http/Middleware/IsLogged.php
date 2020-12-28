<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsLogged {

    public function handle(Request $request, Closure $next) {
        $user = Auth::user();

        if(!$user) {
            return redirect('/login');
        }

        return $next($request);
    }
}
