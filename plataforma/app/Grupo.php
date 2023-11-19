<?php

namespace Plataforma;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use Authenticatable;

    protected $table = 'grupos_archivos';

    protected $fillable = ['id','nombre'];
}
