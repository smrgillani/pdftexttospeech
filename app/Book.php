<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
     protected $fillable = [
        'user_id','name', 'path', 'no_of_pages',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pages()
    {
        return $this->hasMany('App\Page');
    }

    public function chapters()
    {
        return $this->hasMany('App\Chapter');
    }

    public function audioVoices()
    {
        return $this->hasMany('App\BookAudio');
    }
    
}
