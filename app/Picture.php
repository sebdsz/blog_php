<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = [
        'post_id', 'name', 'uri', 'mime', 'size',
    ];

    public function post(){

        return $this->hasOne('App\Post');
    }
}
