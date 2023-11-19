<?php

namespace Plataforma\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Cache;
use Plataforma\Clientes;
use Plataforma\Rastros;
use Session;
use Redirect;
use Plataforma\Http\Requests;
use Plataforma\Http\Requests\LoginRequest;
use Plataforma\Http\Controllers\Controller;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
     public function store(LoginRequest $request)
    {


       if(Auth::attempt(['email' => $request['email'],'password' => $request['contraseña']])){

           $rol=Auth::user()->rol_id;

           //Rastro
           $id=Auth::user()->id;
           $momento=Carbon::now()->toDateTimeString();
           $rastro=['usuario_id'=>$id,'nombre'=>"Se ha conectado a la aplicacion",'momento'=>$momento];
           Rastros::create($rastro);

           //FechaPass
           $user= Auth::user();
           $fechaAlta = $user->fechapass;
           $fecha1 = new \DateTime($fechaAlta);
           $fecha2 = new \DateTime();
           $fecha = $fecha1->diff($fecha2);


           if($rol==1)
           {
              if ($fecha->y>=1) {

                  Session::flash('message-warning','¡Recordatorio¡ Hace un año que no modificas la contraseña,por favor cambiala.');
               }

               return Redirect::to('gestoria');
           }else{

               if ($fecha->y>=1) {

                   Session::flash('message-warning','¡Recordatorio¡ Hace un año que no modificas la contraseña,por favor cambiala.');
               }
               return Redirect::to('cliente');
           }

      }
        Session::flash('message-crede','Usuario y/o Contraseña incorrectos.');
        return Redirect::to('/');
     }


    public function logout(){

        $id=Auth::user()->id;
        $momento=Carbon::now()->toDateTimeString();
        $rastro=['usuario_id'=>$id,'nombre'=>"Se ha desconectado de la aplicacion",'momento'=>$momento];
        Rastros::create($rastro);
        Auth::logout();
        return Redirect::to('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
