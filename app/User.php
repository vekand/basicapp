<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'first_name', 'last_name','email', 'password', 'adresa', 'oras', 'scoala',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

  public function prof()
    {
        return $this->belongsTo('App\Prof');
    }

   public function roles()
    {
        return $this->belongsToMany('App\Role', 'user_role', 'user_id', 'role_id');
    }
public function tournament()
    {
        return $this->hasMany('App\Tournament');
    }
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    public function course()
    {
        return $this->hasMany('App\Course');
    }
   public function courses()
    {
        return $this->belongsToMany('App\Course', 'user_course', 'user_id', 'course_id');
    }
  public function diagrams()
    {
        return $this->belongsToMany('App\Diagram', 'user_diagram', 'user_id', 'diagram_id')->withTimestamps();
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }
    
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}
