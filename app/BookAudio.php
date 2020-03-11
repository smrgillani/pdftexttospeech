<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookAudio extends Model
{

	protected $table = 'book_audios';

	protected $fillable = [
        'book_id','language','voice', 'audio_path','language_code','book_name',
    ];
    
    public function voice()
    {
    	$this->belongsTo('App\Book');
    }
}
