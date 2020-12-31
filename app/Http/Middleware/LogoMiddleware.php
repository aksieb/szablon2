<?php

namespace App\Http\Middleware;

use App\Models\File;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class LogoMiddleware {

    public function handle(
        Request $request,
        Closure $next
    ) {
        $logo = File::where('relation', 'logo')
                    ->first();

        View::share('logo', $logo);

        return $next($request);
    }
}
