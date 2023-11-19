<?php

namespace Plataforma;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;


class Rastros extends Model
{
    use Authenticatable;

    protected $table = 'rastro';

    protected $fillable = ['id','nombre','usuario_id','momento'];




}
