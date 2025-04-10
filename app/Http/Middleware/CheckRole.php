<?php

namespace App\Http\Middleware;



class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        
        foreach ($roles as $role) {
            if ($user->role === $role) {
                return $next($request);
            }
        }

        return redirect('/')->with('error', 'Vous n\'avez pas les permissions nécessaires pour accéder à cette page.');
    }
}