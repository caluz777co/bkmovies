<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    protected $fillable = ['contenido', 'user_id', 'peliculas_id'];
}
