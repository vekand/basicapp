<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
   public function diagram(){
		return $this->belongsTo('App\Diagram');
	}
}
