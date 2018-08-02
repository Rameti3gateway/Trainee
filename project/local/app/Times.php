<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Times extends Model
{
    protected $table = 'time';
    public function user(){
    	return $this->belongsTo('App\User','user_id','id');
    }
}
