<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
       'name','code','membership_id'
    ];

    public function membership()
    {
    	return $this->belongsTo('App\Membership');
    }
    
    public function languagevoices()
    {
    	return $this->hasMany('App\LanguageVoice');
    }
}
