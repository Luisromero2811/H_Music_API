<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//Este es un comentario puesto desde una rama diferente a master

class Cancion extends Model
{
    protected $table = "canciones";
    public function playlist()
    {
        return $this->belongsTo('App\Playlist');
    }
}
