<?php

namespace App\Http\Middleware;

use Auth;
use Route;
use Closure;
use Illuminate\Http\Request;

class Admin
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
        $myData = Auth::guard('admin')->user();
        if ($myData == "") {
            $currentRouteName = Route::currentRouteName();
            return redirect()->route('admin.login', ['r' => $currentRouteName]);
        }
        return $next($request);
    }
}
