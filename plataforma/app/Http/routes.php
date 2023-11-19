<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Ruta Basicas
//Route::get('/', function () {
    //return view('welcome');
//});


Route::get('/','FrontController@index');

Route::get('reviews','FrontController@reviews');
Route::get('admin','FrontController@admin');


Route::get('contacto','GestoriaController@contacto');

Route::get('ajustes','GestoriaController@ajustes');

Route::get('ajustea','UsuarioController@ajustea');

Route::get('asignar','UsuarioController@asignar');
Route::get('acciones','UsuarioController@acciones');
Route::get('gestoriasclientes','UsuarioController@getGestoriasClientes');

Route::post('asignarCliente','UsuarioController@asignarCliente');


Route::resource('registro','RegistroController');
Route::resource('usuario','UsuarioController');
Route::resource('gesto','UsuarioController@gestoria');
Route::post('accio','UsuarioController@accio');
Route::resource('clien','UsuarioController@clientes');
Route::resource('conta','UsuarioController@contable');
Route::post('ponmeGestoria','UsuarioController@ponmeGestoria');



Route::resource('archivo','ArchivoController');
Route::post('archivos','ArchivoController@listing');

Route::post('getLogo','GestoriaController@getLogo');

Route::get('file','ArchivoController@getDropzone');
Route::resource('verificacion','ArchivoController@verificacion');
Route::resource('subirLogo','ArchivoController@subirLogo');

Route::post('storage/create','ArchivoController@save');



Route::resource('borrar','ArchivoController@borrar');
Route::post('procesar','ArchivoController@procesar');
Route::post('esadministrador','ArchivoController@esAdministrador');
Route::post('esusuariocliente','UsuarioController@esUsuarioCliente');

Route::resource('contables','UsuarioController@getContables');

Route::resource('panel','RegistroController@panel');

Route::resource('comentario','ComentarioController@comentar');
Route::post('comentarios','ComentarioController@listing');

Route::resource('gestoria','GestoriaController');
Route::get('gestorias','GestoriaController@listing');
Route::post('existeClave','GestoriaController@existeClave');

Route::resource('cliente','ClienteController');
Route::post('clientes','ClienteController@listing');


Route::resource('login','LogController');

Route::get('logout','LogController@logout');



Route::get('formulario','StorageController@index'); //RUTA PARA SUBIR


Route::get('archivocliente/{archivo}', function ($archivo) {


    $public_path = base_path();
    $url = $public_path.'/informacion/'.$archivo;
    //verificamos si el archivo existe y lo retornamos
    if (\Illuminate\Support\Facades\File::exists($url))
    {
        $completo=\Plataforma\ArchivosCliente::where('ruta',$archivo)->first();
        //Rastro
        $id=\Illuminate\Support\Facades\Auth::user()->id;
        $momento=\Carbon\Carbon::now()->toDateTimeString();
        $rastro=['usuario_id'=>$id,'nombre'=>"Ha accedido al archivo ".$completo->name,'momento'=>$momento];
        \Plataforma\Rastros::create($rastro);

        return response()->download($url);
    }


});

//Route::post('storage/create','ArchivoController@save');//RUTA PARA GUARDA Y PROCESARLA



////hay muchas formas de obtener estos archivos, una de ellas es crear una ruta genérica que nos permita acceder a cada archivo de la siguiente forma
Route::get('storage/{archivo}', function ($archivo) {

    $public_path = public_path();
    $url = $public_path.'/storage/'.$archivo;

    //verificamos si el archivo existe y lo retornamos
    if (Storage::exists($archivo))
    {
        \Illuminate\Support\Facades\Session::flash('message', 'Fondo subido correctamente');
        return response()->download($url);
    }
    //si no se encuentra lanzamos un error 404.
    \Illuminate\Support\Facades\Session::flash('message', 'Error en el fondo');
    return Redirect::to('ajustea');

});



Route::resource('password','ResetPassController@index');
Route::post('password/email','Auth\PasswordController@postEmail');



Route::get('password/reset/{token}','Auth\PasswordController@Reset');
Route::post('password/reset','Auth\PasswordController@postReset');

Route::resource('cambiar','CambiarController@index');
Route::resource('cambiarpass','CambiarController@postPassword');
