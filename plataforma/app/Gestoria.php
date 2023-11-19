<?php

namespace Plataforma;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable;


class Gestoria extends Model
{

    use  Authenticatable;


    protected $table = 'gestoria';

    protected $fillable = ['id','dni','nombre','clave','clave_clientes','logo'];

}
