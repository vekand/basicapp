<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagram extends Model
{
	public function course() {
		return $this->belongsTo('App\Course');
	}

	public function users()
	{
		return $this->belongsToMany('App\User', 'user_diagram', 'diagram_id', 'user_id')->withTimestamps();
	}
	
	public function moves(){
		return $this->hasMany('App\Move');
	}

}
