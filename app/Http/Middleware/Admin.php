<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if (Auth::check()) {//prprisijunges
        if (Auth::user()->role != 'admin') { //jei ne adminas
          return abort(404, 'You have to be admin');//grazink 404 puslapi
        }
      }
      //Auth::check()- tikrina ar prisijunges - grazina true,
      //jei neprisijunges - false
      else {
        return abort(404, 'You have to be admin');
      }
          return $next($request); //jei adminas - ateis cia
      }
  }
