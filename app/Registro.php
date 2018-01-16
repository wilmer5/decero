<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
	public $timestamps = false;
	
    protected $fillable = [
    	'clicks', 'conversiones', 'ganancias', 'gananciashoy', 'cobrado', 'pendiente', 'porcobrar', 'site', 'momento'
    ];
}
