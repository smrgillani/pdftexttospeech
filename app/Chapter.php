<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
	protected $fillable = [
        'book_id','page_from','page_to', 'name','draft','total_pages'
    ];


   public function book()
    {
        return $this->belongsTo('App\Book');
    }
    
    public function pageFrom()
    {
        return $this->belongsTo('App\Page','page_from');
        # code...
    }
    public function pageTo()
    {
       return $this->belongsTo('App\Page','page_to');
    }

    public function audioVoices()
    {
        return $this->hasMany('App\ChapterAudio');
    }
}
