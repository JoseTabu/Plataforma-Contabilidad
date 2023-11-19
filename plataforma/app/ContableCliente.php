<?php

namespace Plataforma;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class ContableCliente extends Model
{

    use Authenticatable;

    protected $table = 'contablecliente';

    protected $fillable = ['usuario_id','clientes_id'];


}
