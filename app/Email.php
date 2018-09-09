<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
        'from',
        'cc',
        'bcc',
        'to',
        'reply_to',
        'subject',
        'body',
        'flags',
        'priority',
    ];
}
