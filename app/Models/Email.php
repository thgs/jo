<?php

namespace App\Models;

use Jo\Extras\HumanByte;
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
        'mailbox',
        'from',
        'cc',
        'bcc',
        'to',
        'reply_to',
        'subject',
        'body',
        'flags',
        'priority',

        'email_account_id',
    ];

    public function getSize()
    {
        return (new HumanByte(strlen($this->body)))->getHumanSize();
    }
}
