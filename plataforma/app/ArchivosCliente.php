<?php

namespace Plataforma;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class ArchivosCliente extends Model
{

    use Authenticatable;

    protected $table = 'archivoscliente';

    protected $fillable = ['id','dni','name','ruta','type','size','procesado','clientes_id','usuario_id','grupo_id'];

    public function clientes(){

        //Muchos files pertenece a un clientes
        return $this->belongsTo('Plataforma\Clientes','id');

    }
}
