<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function canciones()
    {
        return $this->hasMany('App\Cancion');
    }
}
