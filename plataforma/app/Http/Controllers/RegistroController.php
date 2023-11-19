<?php

namespace Plataforma\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\URL;
use Plataforma\Clientes;
use Plataforma\Gestoria;
use Plataforma\Roles;
use Plataforma\User;
use Session;
use Redirect;
use Mail;
use Plataforma\Http\Requests;
use Plataforma\Http\Controllers\Controller;

class RegistroController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $roles=Roles::where('nombre', '<>', 'Administrador')->get();

        foreach($roles as $rol){
            $rolnombres[$rol->id]=$rol['nombre'];
        }


        return view('registro.create',["roles"=>$rolnombres]);
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
     public function store(Requests\RegistroRequest $request)
    {


        $rol_id=$request->all()['rol_id'];

        if($rol_id==2)
        {

            $gestoria=Gestoria::where('clave', '=', $request->all()['clave'])->first();

            if(isset($gestoria))
            {
                $datos=$request->all();
                $datos['gestoria_id']=$gestoria->id;
                User::create($datos);
                Session::flash('message-re','Usuario Registrado Correctamente');
                return Redirect::to('/registro');
            }
            else{
                //Clave mal insertada
                Session::flash('message-credere','La clave introducida es incorrecta');
                return Redirect::to('/registro');
            }
        }
        else if($rol_id==3)
        {


            $gestoria=Gestoria::where('clave_clientes', '=', $request->all()['clave'])->first();
            $cliente=Clientes::where('dni', '=', $request->all()['dni'])->first();

            if(isset($cliente) && isset($gestoria))
            {


                $datos=$request->all();
                User::create($datos);
                Session::flash('message-re','Usuario Registrado Correctamente');
                return Redirect::to('/registro');
            }
            else{
                //Dni no existe
                Session::flash('message-credere','El dni no existe en el sistema');
                return Redirect::to('/registro');
        }

        }

         
            

     }

    public function panel()
    {

        $rol=Auth::user()->rol_id;

        if($rol ==1){


            return response()->json(
                $gestoria="NEXT"
            );

        }else if($rol ==2){

            $id=Auth::user()->gestoria_id;

            $gestoria=Gestoria::where('id','=',$id)->get()->first();



            if($gestoria->logo){
                return response()->json("<img class='logo-corporativo' src='".URL::to('/storage')."/G-".Auth::user()->gestoria_id.".png' />");


            }
            else{
                return response()->json(

                    $gestoria->nombre

                );
            }




        }else if($rol==3){

            $dni=Auth::user()->dni;

            $id=Clientes::where('dni',$dni)->first()->gestoria_id;

            $gestoria=Gestoria::where('id',$id)->first();

            if($gestoria->logo==false)
            {
                return response()->json(

                    $gestoria->nombre

                );
            }else{

                return response()->json("<img class='logo-corporativo' src='".URL::to('/storage')."/G-".$gestoria->id.".png' />");
            }



        }

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
