<?php

namespace Plataforma\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Session;
use Closure;

class Admin
{

    protected $auth;

     public function __construct(Guard $auth){

        $this->auth = $auth;


     }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if($this->auth->user()->rol_id ==1){

            return $next($request);


        }else if($this->auth->user()->rol_id ==4){

            return $next($request);

        }
        else{

          //Session::flash('message-error','No tienes suficientes privilegios');
            abort(404);
          //return redirect()->to('admin');

          }

    }
}
