<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	public function diagrams() {
		return $this->hasMany('App\Diagram');
	}
public function pgns() {
		return $this->hasMany('App\Pgn');
	}
	public function users()
	{
		return $this->belongsToMany('App\User', 'user_course', 'course_id', 'user_id');
	}

	public function tipcourse()
	{
		return $this->belongsTo('App\Tipcourse');
	}

	public function level()
	{
		return $this->belongsTo('App\Level');
	}

public function prof()
	{
		return $this->belongsToThrough('App\Prof', 'App\User');
	}

	    public function hasUser($course, $user)
    {
    	 if ($this->users()->where(['course_id' => $course, 'user_id' => $user])->first()) {
            return true;
        }
        return false;
    }   

}
