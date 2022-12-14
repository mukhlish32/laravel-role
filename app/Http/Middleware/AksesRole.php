<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Session;

class AksesRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $role = Session::get('akses_id');
        $cekAkses = array_slice(func_get_args(), 2);
        
        if(in_array($role, $cekAkses) && Auth::check()){
            return $next($request);
        }
        // return response()->json(["Anda tidak memiliki hak akses di halaman ini"]);
        return abort(404);
    }
}
