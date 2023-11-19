<?php

namespace Plataforma\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Plataforma\Clientes;
use Plataforma\ContableCliente;
use Plataforma\Gestoria;
use Plataforma\Rastros;
use Plataforma\Roles;
use Plataforma\User;
use Plataforma\Http\Requests;
use Plataforma\Http\Requests\UserCreateRequest;
use Plataforma\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Plataforma\Http\Controllers\Controller;
use Illuminate\Routing\Route;

class UsuarioController extends Controller
{



    public function __construct(){

    $this->middleware('auth');
    $this->middleware('admin');
    $this->beforeFilter('@find',['only'=>['edit','update','destroy']]);


    }


    public function find(Route $route){

        $this->user = User::find($route->getParameter('usuario'));
        $this->notFound($this->user);


    }

    public function ajustea()
    {
        $rol=Auth::user()->rol_id;

        if($rol==1){

            return view('ajustea.index');
        }else{

            abort(404);
        }

    }

    public function accio(Request $request)
    {

        //Rastro
        $id=Auth::user()->id;
        $momento=Carbon::now()->toDateTimeString();
        $rastro=['usuario_id'=>$id,'nombre'=>"Ha accedido a las acciones",'momento'=>$momento];
        Rastros::create($rastro);


        if(Auth::user()->rol_id==1)
        {
            $email=$request->all()['email'];
            $email=trim($email);

            $usuario=User::where("email",$email)->first();
            $acciones=Rastros::where("usuario_id",$usuario->id)->orderBy('momento','desc')->get();
            return $acciones;

        }

    }

    public function asignar()
    {
        if(Auth::user()->rol_id==1)
            return view('asignar.index');
    }


    public function acciones()
    {
        $users = User::all();
        if(Auth::user()->rol_id==1)
            return view('acciones.index',compact('users'));
    }


    public function esAdministrador()
    {
        $gestoria_id=Auth::user()->gestoria_id;
        return $gestoria_id==0?true:false;
    }


    //Document
    public function finddocument(Route $route){

        $this->user = User::find($route->getParameter('usuario'));



    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {


        $users = User::paginate(15); // Paginate nos va monstrar el numero que metamos entre paretisi para asi tener una vista mas limpia

        foreach($users as $taibo)
        {

            $taibo['rol'] = Roles::find($taibo['rol_id'])["nombre"];


        }

        return view('usuario.index',compact('users')); //Enviar informacion compact()

    }

    public function gestoria()
    {
        $users = User::paginate(0); // Paginate nos va monstrar el numero que metamos entre paretisi para asi tener una vista mas limpia

        foreach($users as $taibo)
        {

            $taibo['rol']=Roles::find($taibo['rol_id'])['nombre'];
            $taibo['gestoria']=Gestoria::find($taibo['gestoria_id'])['nombre'];


        }

        return view('usuario.indexg',compact('users')); //Enviar informacion compact()

    }

    public function clientes()
    {
        $users = User::paginate(0); // Paginate nos va monstrar el numero que metamos entre paretisi para asi tener una vista mas limpia

        foreach($users as $taibo)
        {


            if($taibo['rol_id']=="3")
            {

                $cliente=Clientes::where('dni',$taibo['dni'])->first()['gestoria_id'];

                $taibo['rol']=Roles::find($taibo['rol_id'])['nombre'];
                $taibo['gestoria']=Gestoria::find($cliente)['nombre'];
            }



        }

        return view('usuario.indexc',compact('users')); //Enviar informacion compact()

    }


    public function contable()
    {
        $users = User::paginate(15); // Paginate nos va monstrar el numero que metamos entre paretisi para asi tener una vista mas limpia

        foreach($users as $taibo)
        {

            $taibo['rol'] = Roles::find($taibo['rol_id'])["nombre"];


        }

        return view('usuario.indexco',compact('users')); //Enviar informacion compact()

    }


    public function esUsuarioCliente()
    {
        $mirol=Auth::user()->rol_id;

        if($mirol==3){

            return response()->json(
                true
            );

        }else{

            return response()->json(
                false
            );
        }
    }

    public function getContables(){
        if(Auth::user()->rol_id==1)
        {
            $contables=User::where('rol_id','4')->get();


            foreach($contables as $contable)
            {
                $nuevosclientes=[];
                $clientes=ContableCliente::where('usuario_id',$contable->id)->get();

                foreach($clientes as $cliente){

                    array_push($nuevosclientes,Clientes::where('id',$cliente->clientes_id)->first());


                }
                $contable->cliente=$nuevosclientes;
            }

            return $contables;
        }
    }

    public function getGestoriasClientes(){

        if(Auth::user()->rol_id==1)
        {
            $clientesSelec=ContableCliente::all('clientes_id');

            //Transformacion a array
            $cliselect2=[];
            foreach($clientesSelec as $cli)
            {

                array_push($cliselect2,$cli->clientes_id);
            }

            //Algoritmo normal
            //$gestorias=Gestoria::all();
            $gestorias=Gestoria::where("id",'>',0)->get();

            foreach($gestorias as $gestoria)
            {
                $clientes=Clientes::where('gestoria_id',$gestoria->id)->get();
                $nuevosclientesNoSelect=[];

                //Eliminar los ya asignados
                foreach($clientes as $cliente)
                {

                    if(!in_array($cliente->id,$cliselect2)){
                        array_push($nuevosclientesNoSelect,$cliente);
                    }
                }

                $gestoria->clientes=$nuevosclientesNoSelect;

            }

            return $gestorias;
        }

    }

    public function asignarCliente(Request $request){

        if(Auth::user()->rol_id==1) {


            $contable=$request->all()['contable'];
            $datos['usuario_id']=$contable;
            ContableCliente::where('usuario_id',$contable)->delete();

            if(isset($request->all()['clientes']))
            {
                $clientes=$request->all()['clientes'];
                foreach($clientes as $cliente)
                {
                    $datos['clientes_id']=$cliente;
                    ContableCliente::create($datos);
                }
            }

            return response()->json();

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $gestorias =  Gestoria::all();

        //Genera el array apropiado para el select
        foreach($gestorias as $gestoria)
        {
            $arrayg[$gestoria->id]=$gestoria->nombre;
        }

        $roles =  Roles::all();

        //Genera el array apropiado para el select
        foreach($roles as $rol)
        {
            $arrayr[$rol->id]=$rol->nombre;
        }


        return view('usuario.create',["gestoria"=>$arrayg,"rol"=>$arrayr]);
    }

    public function ponmeGestoria(Request $request){

        $id=intval($request->all()['id']);
        $gestoria=Gestoria::where('id',$id)->first();
        Session::put('gestoria',$gestoria);
        return response()->json();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(UserCreateRequest $request)
    {

        $rol_id=$request->all()['rol_id'];

        if($rol_id==3)
        {
            $cliente=Clientes::where('dni', '=', $request->all()['dni'])->first();

            if(isset($cliente))
            {
                $datos=$request->all();
                User::create($datos);
                Session::flash('message','Usuario Registrado Correctamente'); //Session para monstrar lo que queremos una vez editado
                return Redirect::to('/clien');
            }
            else{
                //Dni no existe
                Session::flash('message-error','El cliente no está registrado en la base de datos');
                return Redirect::to('/usuario/create');
            }
        }else{

            $datos=$request->all();
            User::create($datos);
            Session::flash('message','Usuario Registrado Correctamente'); //Session para monstrar lo que queremos una vez editado
            if($rol_id==1)
                return Redirect::to('/usuario');
            elseif($rol_id==2){

                return Redirect::to('/gesto');

            }elseif($rol_id==4){

                return Redirect::to('/conta');
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
    public function edit()
    {
        $gestorias =  Gestoria::all();

        //Genera el array apropiado para el select
        foreach($gestorias as $gestoria)
        {
            $array_gestorias[$gestoria->id]=$gestoria->nombre;
        }

        $roles =  Roles::all();

        //Genera el array apropiado para el select
        foreach($roles as $rol)
        {
            $array_roles[$rol->id]=$rol->nombre;
        }

        return view('usuario.edit',['user'=>$this->user,"gestoria"=>$array_gestorias,"rol"=>$array_roles]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UserUpdateRequest $request)
    {

        $rol_id= $request->all()['rol_id'];

        $this->user->fill($request->all()); //Para almacenar la actulizacion del usuario utilizando el metodo fill();
        $this->user->save();

        Session::flash('message','Usuario Editado correctamente'); //Session para monstrar lo que queremos una vez editado

        if($rol_id==3)
        {
            return Redirect::to('/clien'); //Redirecionar a la vista
        }elseif($rol_id==2)
        {
            return Redirect::to('/gesto'); //Redirecionar a la vista
        }elseif($rol_id==4)
        {
            return Redirect::to('/conta'); //Redirecionar a la vista
        }
        else{
            return Redirect::to('/usuario'); //Redirecionar a la vista
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

        $this->user->delete();

        Session::flash('message','Usuario Eliminado Correctamente'); //Session para monstrar lo que queremos una vez editado
        return Redirect::to('/usuario'); //Redirecionar a la vista
//        if($rol_id==3)
//        {
//            return Redirect::to('/clien'); //Redirecionar a la vista
//        }elseif($rol_id==2)
//        {
//            return Redirect::to('/gesto'); //Redirecionar a la vista
//        }elseif($rol_id==4)
//        {
//            return Redirect::to('/conta'); //Redirecionar a la vista
//        }
//        else{
//            return Redirect::to('/usuario'); //Redirecionar a la vista
//        }





    }


}

