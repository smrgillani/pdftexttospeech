<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'name', 'status', 'price', 'voice_type', 'characters_length', 'package_id',
    ];
    /*Relations*/

    public function users()
    {
        return $this->hasOne('App\User');
    }

    public function languages()
    {
        return $this->hasMany('App\Language');
    }
    public function package()
    {
        return $this->belongsTo('App\Package');
    }
}
