<?php

namespace App\Http\Middleware;

use App\Models\Log;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogActivity
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Logger les connexions réussies uniquement
        if ($request->is('login') && $response->getStatusCode() === 302) {
            $user = auth()->user();
            if ($user) {
                Log::logAction('connexion', "Connexion réussie de l'utilisateur {$user->name} ({$user->email})");
            }
        }

        return $response;
    }
}
