<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function membership()
    {
        return $this->hasOne(Membership::class);
    }
// this is a recommended way to declare event handlers
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($package) {
            // before delete() method call this
            $package->membership()->delete();
            // do the rest of the cleanup...
        });
    }
}
