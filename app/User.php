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
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {

        return $this->hasMany('App\Post');
    }

    public function isAdmin()
    {
        return ($this->role === 'administrator');
    }

    public function hasRated(Post $post)
    {
        foreach ($post->scores as $score) {
            if ($score->user_id === $this->id) return false;
        }

        return true;
    }
}
