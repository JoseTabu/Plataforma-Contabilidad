<?php

namespace Plataforma\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Plataforma\ArchivosCliente;
use Plataforma\Clientes;
use Plataforma\Gestoria;
use Plataforma\Http\Requests;
use Plataforma\Http\Requests\GestoriaRequest;
use Illuminate\Routing\Route;
use Plataforma\Http\Controllers\Controller;
use Plataforma\Rastros;
use Plataforma\User;


class GestoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct(){
        $this->middleware('auth');
        $this->beforeFilter('@find',['only' => ['edit','update','destroy']]);
    }


    public function find(Route $route){

        $this->nombre = Gestoria::find($route->getParameter('gestoria'));
        $this->notFound($this->nombre);


    }

    public function getLogo(Request $request)
    {
        $imagen="<img class='' src='".URL::to('/storage')."/G-".$request->all()['id'].".png";
        return response()->json( //Responde mediante json,le pasamos neustras gestorias por un array
            array("imagen"=>$imagen) //Le pasamos nuestras gestorias
        );
    }

    public function listing()
    {

        $rol=Auth::user()->rol_id;

        //Rastro
        $id=Auth::user()->id;
        $momento=Carbon::now()->toDateTimeString();
        $rastro=['usuario_id'=>$id,'nombre'=>"Ha accedido a las gestorias",'momento'=>$momento];
        Rastros::create($rastro);

        if($rol==1)
        {
            $gestoria=Gestoria::where("id",'>',0)->get();//Filtramos para que la gestoria cero que esta asociada al admin no aparezca por seguridad.

            for ($i = 0; $i < count($gestoria); $i++) {
                $clientes=Clientes::where("gestoria_id",$gestoria[$i]['id'])->get();

                for($j = 0; $j < count($clientes); $j++){
                    $archivos=ArchivosCliente::where('procesado',0)->where('clientes_id',$clientes[$j]['id'])->get();
                    if(count($archivos)>0)
                        $gestoria[$i]->procesados=1;
                }

            }


                return response()->json( //Responde mediante json,le pasamos neustras gestorias por un array
                    $gestoria->toArray() //Le pasamos nuestras gestorias
                );

        }

    }

    public function contacto()
    {
        if(Auth::user()->rol_id==2){
            //Rastro
            $id=Auth::user()->id;
            $momento=Carbon::now()->toDateTimeString();
            $rastro=['usuario_id'=>$id,'nombre'=>"Ha accedido a contactos",'momento'=>$momento];
            Rastros::create($rastro);
            return view('contacto.index');
        }else{

            abort(404);
        }

    }

    public function ajustes()
    {
        if(Auth::user()->rol_id==2){

            //Rastro
            $id=Auth::user()->id;
            $momento=Carbon::now()->toDateTimeString();
            $rastro=['usuario_id'=>$id,'nombre'=>"Ha accedido a ajustes",'momento'=>$momento];
            Rastros::create($rastro);

            return view('ajustes.index');
        }else{

            abort(404);
        }

    }




    public function index()
    {
        $rol=Auth::user()->rol_id;

        if($rol==1) {
            $gestorias = Gestoria::paginate(2);
            return View::make('gestoria.index')->with(compact('gestorias'));
        }else{

            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $rol=Auth::user()->rol_id;

        if($rol==1) {

            return view('gestoria.create');

        }else{

            abort(404);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(GestoriaRequest $request)
    {
        if($request->ajax()){
            Gestoria::create($request->all());
            return response()->json([
                "mensaje" => "creado"
            ]);
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

        $rol=Auth::user()->rol_id;

        if($rol==1 || $rol==2) {
            $gestoria = Gestoria::find($id); //Encontrar una gestoria que estamos enviando

            return response()->json(  //Responder con tipo json le pasamos uan gestoria lo convertimos en array
                $gestoria->toArray()
            );
        }else{

            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(GestoriaRequest $request, $id)
    {
        $rol=Auth::user()->rol_id;

        if($rol==1) {
            $gestoria = Gestoria::find($id);
            $gestoria->fill($request->all());
            $gestoria->save();
            return response()->json([
                "mensaje" => "listo"
            ]);

        }else{

            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        $this->nombre->delete();
        return response()->json(["mensaje"=>"borrado"]);
    }


    public function existeClave($clave)
    {
        return $clave;
    }
}
