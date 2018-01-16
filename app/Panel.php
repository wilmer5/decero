<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    public function user() {

    	return $this->belongsTo('App\User', 'foreign_key', 'site');
    }
}
