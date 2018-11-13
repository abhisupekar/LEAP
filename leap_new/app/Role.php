<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    Public function departments() {
        return $this->belongsToMany('App\Models\User');
    }
}
