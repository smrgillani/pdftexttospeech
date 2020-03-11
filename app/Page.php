<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	protected $fillable = [
        'book_id','page_no', 'content',
    ];


    public function book()
    {
        return $this->belongsTo('App\Book');
    }

     public function audioVoices()
    {
        return $this->hasMany('App\PageAudio');
    }
}
