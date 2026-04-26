<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AppAccess
{
	public function handle(Request $request, Closure $next)
	{
		// Por ahora solo permite el acceso
		// Más adelante aquí irá la lógica de sesión / autenticación de la App móvil
		return $next($request);
	}
}