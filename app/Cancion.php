<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cancion extends Model
{
    protected $table = "canciones";
    public function playlist()
    {
        return $this->belongsTo('App\Playlist');
    }
}
