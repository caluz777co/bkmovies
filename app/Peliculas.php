<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peliculas extends Model
{
    protected $fillable = ['title', 'url_image', 'id_categoria', 'likes', 'description', 'year', 'director', 'status'];

}
