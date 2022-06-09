<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaylistUser extends Model
{
    protected $table = "playlists_usuarios";
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
