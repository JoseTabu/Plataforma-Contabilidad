<?php

namespace Plataforma;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;


class Clientes extends Model
{
    use Authenticatable;

    protected $table = 'clientes';

    protected $fillable = ['id','dni','nombre','gestoria_id'];

    public function archivo(){

        //Los clientes tienen muchos archivos
        return $this->hasMany('Plataforma\ArchivosCliente','clientes_id');

    }


}
