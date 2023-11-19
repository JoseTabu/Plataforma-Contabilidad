<?php

namespace Plataforma\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Plataforma\Comentarios;
use Plataforma\Http\Requests;
use Plataforma\Http\Controllers\Controller;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     *
     *
     */


    public function __construct(){
        $this->middleware('auth');

    }
    public function index()
    {
        //
    }

    public function listing(Request $request)
    {

        $archivo_id=$request->all()['archivo_id'];

        $comentarios=Comentarios::where("archivo_id",$archivo_id)->get();

        return response()->json( //Responde mediante json,le pasamos nuestros generos por un array
            $comentarios->toArray() //Le pasamos nuestros generos

        );


    }

    public function comentar(Request $request)
    {

        $datos=$request->all();

        $datos['usuario_id']=Auth::user()->id;

        $mytime = Carbon::now();

        $datos['fecha']=$mytime->toDateString();


        Comentarios::create($datos);

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
