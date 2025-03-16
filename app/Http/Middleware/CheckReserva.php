<?php

namespace App\Http\Middleware;

use App\Models\Reserva;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckReserva
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $reservaId = $request->route('reserva');
        $reserva = Reserva::find($reservaId);

        if (!$reserva || $reserva->user_id !== $user->id) {
            return response()->view('errors.page404');
        }

        return $next($request);
    }

}
