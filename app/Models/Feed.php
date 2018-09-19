<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
        'update_every',
        'user_id',
    ];

    // Relations

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
}
