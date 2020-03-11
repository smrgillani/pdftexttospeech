<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LanguageVoice extends Model
{
	protected $table = 'language_voices';

    protected $fillable = [
       'language_id','name','ssml_gender','natural_sample_rate_hertz'
    ];

	public function language()
    {
    	return $this->belongsTo('App\Language');
    }
}
