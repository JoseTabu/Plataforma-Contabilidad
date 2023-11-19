<?php

namespace Plataforma\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Array_;
use Plataforma\ArchivosCliente;
use Plataforma\ContableCliente;
use Plataforma\Http\Requests;
use Plataforma\Http\Requests\ClienteRequest;
use Plataforma\Clientes;
use Illuminate\Routing\Route;
use Plataforma\Http\Controllers\Controller;
use Plataforma\Rastros;
use Plataforma\User;

class ClienteController extends Controller
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


        $this->name= Clientes::find($route->getParameter('cliente'));
        $this->notFound($this->name);

    }



    public function listing()
    {

        $rol=Auth::user()->rol_id;

        //Rastro
        $id=Auth::user()->id;
        $momento=Carbon::now()->toDateTimeString();
        $rastro=['usuario_id'=>$id,'nombre'=>"Ha accedido a su listado de clientes",'momento'=>$momento];
        Rastros::create($rastro);

        if($rol==1){

            $id_gestoria=Session::get('gestoria')->id;

            $clientes=Clientes::where("gestoria_id",$id_gestoria)->get();

            foreach($clientes as $cliente)
            {

                $archivos=ArchivosCliente::where("clientes_id",$cliente->id)->where("procesado","0")->get();
                $cliente->noProcesados=count($archivos);

            }


            return response()->json(
                $clientes

            );


        }elseif($rol==2)
        {

            $id_gestoria=Auth::user()->gestoria_id;
            $clientes=Clientes::where("gestoria_id",$id_gestoria)->get();

            foreach($clientes as $cliente)
            {

                $archivos=ArchivosCliente::where("clientes_id",$cliente->id)->where("procesado","0")->get();
                $cliente->noProcesados=count($archivos);

            }

            return response()->json(
                $clientes

            );

        }elseif($rol==3)
        {
            $dni=Auth::user()->dni;
            $clientes=Clientes::where('dni',$dni)->first();
            $id=$clientes->id;
            $archivos=ArchivosCliente::where("clientes_id",$id)->get();
            $clientes->noProcesados=count($archivos);




        }elseif($rol==4)
        {
            $misclientes=ContableCliente::where('usuario_id',Auth::user()->id)->get();
            $clientes=array();

            foreach($misclientes as $cliente)
            {
                $nuevoCliente=Clientes::where('id',$cliente->clientes_id)->first();

                $archivos=ArchivosCliente::where("clientes_id",$nuevoCliente->id)->where("procesado","0")->get();
                $nuevoCliente->noProcesados=count($archivos);
                array_push($clientes,$nuevoCliente);
            }

            return response()->json( //Responde mediante json,le pasamos nuestros generos por un array
                $clientes //Le pasamos nuestros generos

            );
        }



        return response()->json( //Responde mediante json,le pasamos nuestros generos por un array
            $clientes->toArray() //Le pasamos nuestros generos

        );




    }

    public function index()
    {

        $clientes = User::paginate(3);

        return view('cliente.index',compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $rol=Auth::user()->rol_id;

        if($rol==1 || $rol==2){

            return view('cliente.create');

        }else{

            abort(404);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ClienteRequest $request)
    {
        if($request->ajax()){
            $datos=$request->all();


            $rol=Auth::user()->rol_id;

            if($rol==2)
            {
                $datos['gestoria_id']=Auth::user()->gestoria_id;

                $cliente=Clientes::create($datos);

                return response()->json([
                    $request->all()
                ]);

            }elseif($rol==1)
            {
                $datos['gestoria_id']=Session::get('gestoria')->id;

                $cliente=Clientes::create($datos);

                return response()->json([
                    $request->all()
                ]);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($clientes)
    {


        return response()->json(  //Responder con tipo json le pasamos a genero lo convertimos en array
            Clientes::find($clientes)->toArray()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\ClienteUpdateRequest $request, $id)
    {

        $cliente = Clientes::find($id);

        $cliente->fill($request->all());
        $cliente->save();
        return response()->json([
            "mensaje" => "listo"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        $this->name->delete();
        return response()->json(["mensaje"=>"borrado"]);
    }
}
