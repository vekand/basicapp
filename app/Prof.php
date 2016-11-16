<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prof extends Model
{
	
   public function users() {
		return $this->hasMany('App\User');
	}

	public function courses()
    {
        return $this->hasManyThrough('App\Course', 'App\User', 'prof_id', 'user_id', 'id');
    }
}
