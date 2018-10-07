<?php

namespace Jo\IMAP;

use App\Models\EmailAccount;
use Jo\IMAP\Drivers\Ddeboer as Driver;

class ImapRepository
{
    protected $driver;

    public function __construct(EmailAccount $account)
    {
        $this->account = $account;
        $this->driver = new Driver($account);

        //Connect to the IMAP Server
        $this->driver->connect();
    }

    // this kinda escapes the repository boundaries..
    // but can be convenient for
    public function __call($method, $parameters)
    {
        if (method_exists($this->driver, $method))
            return $this->driver->$method(...$parameters);
        else
            throw new \Exception(__CLASS__.': '.$method.' is not defined!');
    }

    public function __sleep()
    {
        $this->driver->disconnect();
    }
}
