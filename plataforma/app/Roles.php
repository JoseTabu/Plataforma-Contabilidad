<?php

namespace Plataforma;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = "roles";

    protected $fillable = ['id','nombre'];


}
