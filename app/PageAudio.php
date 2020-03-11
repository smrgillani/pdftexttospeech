<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageAudio extends Model
{
	protected $table = 'page_audios';
	
   protected $fillable = [
       'book_id','page_id', 'language','voice','audio_path'
    ];


    public function voice()
    {
    	$this->belongsTo('App\Page');
    }


}
