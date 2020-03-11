<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChapterAudio extends Model
{
    protected $table = 'chapter_audios';

	protected $fillable = [
        'chapter_id','language','voice', 'audio_path','language_code','chapter_name'
    ];
    
    public function voice()
    {
    	$this->belongsTo('App\Chapter');
    }
}
