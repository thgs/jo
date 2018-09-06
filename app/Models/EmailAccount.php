<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailAccount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id',
        'username',
        'password',
        'host',
        'port',
        'encryption',
        'protocol'
    ];

    // Relations ---------------------------------------------------------------

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
