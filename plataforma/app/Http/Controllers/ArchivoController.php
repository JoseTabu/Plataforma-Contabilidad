<?php

namespace Plataforma\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Exception;
use Plataforma\Clientes;
use Plataforma\ArchivosCliente;
use Plataforma\ContableCliente;
use Plataforma\Gestoria;
use Plataforma\Http\Requests;
use Plataforma\Http\Controllers\Controller;
use Plataforma\User;



class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct(){
        $this->middleware('auth');

    }



    public function getDropzone()
    {
        return view("files.index");
    }


    public function borrar(Request $request)
    {

        $file = Input::file('file');
        $nombre=$request->all()['nombre'];



        $archivo=ArchivosCliente::where("name",$nombre)->first();




        try{

            Storage::delete($archivo->ruta);

        }catch (Exception $e)
        {

        }

        ArchivosCliente::destroy($archivo->id);

        return response()->json(
        );



    }

    public function procesar(Request $request)
    {

        //dd(Input::all());
        //return dd;

        $name=$request->all()['name'];
        $rol=Auth::user()->rol_id;

        if($rol==1)
        {

            $archivo = ArchivosCliente::where('name',$name)->first();
            $cambio=$archivo->procesado?false:true;
            $archivo->procesado=$cambio;
            $archivo->save();

            return response()->json(
            );

        }elseif($rol==2)
        {

            $archivo = ArchivosCliente::where('name',$name)->first();

            $gestoria_id=Auth::user()->gestoria_id;

            $cliente=$archivo->clientes_id;

            $clienteTeorico=Clientes::where('id',$cliente)->first();

            if($clienteTeorico->gestoria_id==$gestoria_id)
            {

                $cambio=$archivo->procesado?false:true;
                $archivo->procesado=$cambio;
                $archivo->save();

                return response()->json(
                );
            }

        }elseif($rol==3)
        {

            $cliente=Auth::user()->cliente_id;

            $archivo = ArchivosCliente::where('name',$name)->first();

            $puede=$cliente->clientes_id==$cliente?true:false;

            if($puede)
            {
                $cambio=$archivo->procesado?false:true;
                $archivo->procesado=$cambio;
                $archivo->save();

                return response()->json(
                );
            }

        }elseif($rol==4)
        {

            $archivo = ArchivosCliente::where('name',$name)->first();
            $id_cliente=$archivo->clientes_id;

            $contabilizador=ContableCliente::where('clientes_id',$id_cliente)->first();


            if($contabilizador->usuario_id==Auth::user()->id)
            {
                $cambio=$archivo->procesado?false:true;

                $archivo->procesado=$cambio;
                $archivo->save();
                return response()->json(
              
                );
            }

        }
    }

    public function esAdministrador()
{
    $mirol=Auth::user()->rol_id;

    if($mirol==1 || $mirol==4) {

        return response()->json(
            true
        );
    }else{

        return response()->json(
            false
        );
    }
}

    public function subirLogo(Request $request)
    {
        $rol=Auth::user()->rol_id;


        if($rol==2)
        {


            $file = array('image' => Input::file('image'));

            // setting up rules
            $rules = array('image' =>'required|mimes:png,PNG'); //mimes:jpeg,bmp,png and for max size max:10000
            // doing the validation, passing post data, rules and the messages //ESTO QUE LA COPIAO NO SIN VERGUENZA
            $validator = \Illuminate\Support\Facades\Validator::make($file, $rules);

            if ($validator->fails()) {
                // send back to the page with the input data and errors
                return Redirect::to('ajustes')->withInput()->withErrors($validator);
            }
            else {
                // checking file is valid.
                if (Input::file('image')->isValid()) {
                    $gestoria_id=Auth::user()->gestoria_id;
                    $gestoria=Gestoria::where('id',$gestoria_id)->first();
                    $gestoria->logo=1;
                    $gestoria->save();
                    $destinationPath = public_path() . '/storage/';// upload path
                    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                    $fileName = "G-".$gestoria_id . '.' . $extension; // renameing image
                    if(Input::file('image')->move($destinationPath, $fileName))
                    {

                        if (Storage::exists($gestoria->logo=1))
                        {
                            return response()->download($destinationPath);

                        }

                    }else{

                        abort(404);


                    }// uploading file to given path
                    // sending back with message
                    \Illuminate\Support\Facades\Session::flash('message','Logo subido correctamente');
                    return Redirect::to('ajustes');
                } else {
                    // sending back with error message.
                    Session::flash('mesage-error','Error en la subida');
                    return Redirect::to('ajustes');
                }


            }


        }
        return Redirect::to('ajustes');
    }



    public function save(Request $request)
    {

        $rol = Auth::user()->rol_id;

        if ($rol == 1) {

            //obtenemos el campo file definido en el formulario
            $file = $request->file('file');

            $rules = array('file' =>'required|mimes:png,PNG'); //mimes:jpeg,bmp,png and for max size max:10000
            // doing the validation, passing post data, rules and the messages //ESTO QUE LA COPIAO NO SIN VERGUENZA
            $validator = \Illuminate\Support\Facades\Validator::make( array('file'=> $file) , $rules);

            if ($validator->fails()) {

                return Redirect::to('ajustea')->withInput()->withErrors($validator);
            }else if($validator->passes()) {

                //obtenemos el nombre del archivo
                $extension = Input::file('file')->getClientOriginalExtension(); // getting image extension
                $fileName = "fondo" . '.' . $extension; // renameing image

                //indicamos que queremos guardar un nuevo archivo en el disco local
                \Storage::disk('local')->put($fileName, \File::get($file));

                \Illuminate\Support\Facades\Session::flash('message', 'Fondo subido correctamente');
                return Redirect::to('ajustea');
            }else{

                \Illuminate\Support\Facades\Session::flash('message-error', 'Error en la subida');
                return Redirect::to('ajustea');
            }
        }

    }





    public function verificacion(Request $request)
    {


        $rol=Auth::user()->rol_id;


        if($request->cliente_id || $rol==3)
        {
            $fileInput = Input::file('file');

            if(Input::hasFile('file')) {

                $path = public_path() . '/storage/';

                $fileType = $fileInput->guessExtension();

                $fileSize = $fileInput->getClientSize() / 1024;

                if($rol==2||$rol==1||$rol==4)
                {
                    $cliente_id = $request->cliente_id;

                }
                elseif($rol==3)
                {
                    $dni=Auth::user()->dni;

                    $cliente_id=Clientes::where('dni',$dni)->first()->id;
                }
                $grupo_id =$request->grupo_id;

                $clienteSubido=Clientes::where('id',$cliente_id)->first();
                $dni=$clienteSubido->dni;


                $file = new ArchivosCliente;

                if($request->nuevo_nombre){
                    $file->name = $request->nuevo_nombre."_".$dni.".".$fileType;

                    $fileName = $request->nuevo_nombre."_".$dni.".".$fileType;

                }else{

                    $punto=strrpos($fileInput->getClientOriginalName(),".","-1");
                    $nombreReal=substr($fileInput->getClientOriginalName(),0,$punto);

                    $nombreReal = str_replace("_","-",$nombreReal);

                    $fileName=$nombreReal."_".$dni.".".$fileType;
                    $file->name = $fileName;

                }


               // $file->ruta = $path;
                $file->ruta = Hash::make($file->name)."A.".$fileType;
                $file->ruta=str_replace("/","a",$file->ruta);


                $file->type = $fileType;
                $file->size = $fileSize;



                if ($fileInput->move($path,$file->ruta)) {

                    $file->clientes_id = $cliente_id;
                    $file->grupo_id=$grupo_id;
                    if($file->grupo_id==1)
                        $file->procesado=1;
                    $file->usuario_id=Auth::user()->id;
                    $file->save();

                }
            }
            else{
                return false;
            }
        }else{
            return false;
        }

    }




    public function listing(Request $request)
    {

        $rol=Auth::user()->rol_id;

        if($rol==2||$rol==1)
        {

            $id=$request->all()['id'];

            $archivos=ArchivosCliente::where("clientes_id",$id)->get();

            foreach($archivos as $archivo)
            {
                $usuario=User::where("id",$archivo['usuario_id'])->get();

                $archivo['usuario_id']=$usuario[0]['name'];
            }



        }elseif($rol==3)
        {
            $dni=Auth::user()->dni;
            $id=Clientes::where('dni',$dni)->first()->id;

            $archivos=ArchivosCliente::where("clientes_id",$id)->get();

            foreach($archivos as $archivo)
            {
                $usuario=User::where("id",$archivo['usuario_id'])->get();

                $archivo['usuario_id']=$usuario[0]['name'];
            }



        }elseif($rol==4)
        {
            $id=$request->all()['id'];

            if(ContableCliente::where('clientes_id',$id)->get())
            {

                $archivos=ArchivosCliente::where("clientes_id",$id)->get();

                foreach($archivos as $archivo)
                {
                    $usuario=User::where("id",$archivo['usuario_id'])->get();

                    $archivo['usuario_id']=$usuario[0]['name'];
                }
            }



        }


        return response()->json(
            $archivos->toArray()
        );
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
