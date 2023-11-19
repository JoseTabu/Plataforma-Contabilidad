<?php

namespace Plataforma\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Plataforma\Http\Requests;
use Plataforma\Http\Controllers\Controller;
use Plataforma\User;
use Symfony\Component\Console\Input\Input;

class CambiarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('cambiar.cambiar');
    }



    public function postPassword(Request $request)
    {


        $user=Auth::user();

        $rules = array(
            'Contraseña_Actual'=>'required',
            'Nueva_Contraseña'=>'required|min:6',
            'Repetir_Contraseña'=>'required|min:6|same:Nueva_Contraseña'
        );


        $messages = array(
            'required'=>'El campo :attribute es obligatorio.',
            'min'=>'El campo :attribute no puede tener menos de :min carácteres.'
        );


        $validation = Validator::make($request->all(),$rules, $messages);

        if ($validation->fails())
        {

            return Redirect::to('cambiar')->withErrors($validation)->withInput();
        }
        else{
            if (Hash::check($request->all()['Contraseña_Actual'],$user->password))
            {


                $user->password = $request->all()['Nueva_Contraseña'];

                $date = Carbon::now();
                $user->renueva=1;
                $user->fechapass= $date->toDateTimeString();
                $user->save();




                if($user->save()){


                    Session::flash('message','Nueva contraseña guardada correctamente');
                    return Redirect::to('cambiar');
                }
                else
                {
                    Session::flash('message-error','No se ha podido guardar la nueva contaseña');
                    return Redirect::to('cambiar');
                }
            }
            else
            {
                Session::flash('message-error','La contraseña actual no es correcta');
                return Redirect::to('cambiar');
            }

        }
    }

//    public function fecha()
//    {
//
//        $user= Auth::user();
//        $fechaAlta = $user->fechapass;
//
//        $fecha1 = new \DateTime($fechaAlta);
//        $fecha2 = new \DateTime();
//        $fecha = $fecha1->diff($fecha2);
//
//
//        if ($fecha->y>=1) {
//
//
//            return response()->json(
//                true
//            );
//
//        } else {
//
//            return response()->json(
//                false
//            );
//        }
//
//    }


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
    public function store()
    {
        //
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
