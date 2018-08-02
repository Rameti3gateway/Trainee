<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = 'task';
    protected $fillable = [
       'id', 'user_id','detail', 'date',
    ];
    public function user(){
    	return $this->belongsTo('App\User','user_id','id');
    }
    
}
