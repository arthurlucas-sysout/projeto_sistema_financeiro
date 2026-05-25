<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\UserRole;

class CheckAdmin
{


    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->role != UserRole::ADMIN) {
            abort(403); // criar uma blade de erro para que o abort o use automaticamente
        }

        return $next($request);
    }
}
