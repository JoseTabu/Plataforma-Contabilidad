<?php

namespace Plataforma;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Comentarios extends Model
{
    use Authenticatable;

    protected $table = 'comentarios';

    protected $fillable = ['usuario_id','archivo_id','comentario','fecha'];


}
