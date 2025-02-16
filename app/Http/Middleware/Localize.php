<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class Localize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
          /*  if(! in_array($request->segment(1),config('app.available_locales'))){
        abort(400);
       }*/
      // App::setLocale($request->segment(1));

      App::setLocale($request->header('Language',$request->segment(1)??'en'));
      return $next($request);

    }
}
