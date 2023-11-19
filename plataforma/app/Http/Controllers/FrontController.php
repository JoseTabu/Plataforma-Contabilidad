<?php

namespace Plataforma\Http\Controllers;

use Illuminate\Http\Request;
use Plataforma\Gestoria;
use Plataforma\Http\Requests;
use Plataforma\Http\Controllers\Controller;

class FrontController extends Controller
{


     public function __construct(){

        $this->middleware('auth',['only'=>'admin']);



     }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('index');
    }

     public function registro()
    {
        $gestorias = Gestoria::all();

        //Genera el array apropiado para el select
        foreach($gestorias as $gestoria)
        {
            $array[$gestoria->id]=$gestoria->nombre;
        }
        return view('usuario.create',["gestoria"=>$array]);
    }

    


     public function reviews()
    {
        return view('reviews');
    }

     public function admin()
    {
        return view('admin.index');
    }
}
