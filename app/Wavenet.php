<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wavenet extends Model
{
     protected $fillable = [
       'language','code', 'name','ssml_gender','natural_sample_rate_hertz'
    ];
}
