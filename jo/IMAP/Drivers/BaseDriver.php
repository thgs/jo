<?php

namespace Jo\IMAP\Drivers;

use App\Models\EmailAccount;
use Ddeboer\Imap\Exception\AuthenticationFailedException;

abstract class BaseDriver
{
	protected $client;

    protected $account;

    protected $connectionStatus;

    protected $error;

    public function __construct(EmailAccount $account)
    {
        $this->account = $account;

        $this->boot();
        try {
            $this->connectionStatus = $this->connect();
        } catch (AuthenticationFailedException $e) {
            $this->error = $e->getMessage();
        }
    }

    abstract public function boot();

	public function setClient($client)
	{
		$this->client = $client;
	}

	public function getClient($client)
	{
		return $this->client;
	}

    public function getConnectionStatus()
    {
        return $this->connectionStatus;
    }

    public function connect()
    {
        return $this->client->connect();
    }

    public function disconnect()
    {
        return $this->client->disconnect();
    }

	 // this kinda escapes the repository boundaries..
    // but can be convenient for
    public function __call($method, $parameters)
    {
        if (method_exists($this->client, $method))
            $this->client->$method(...$parameters);
        else
            throw new \Exception(__CLASS__.': '.$method.' is not defined!');
    }

    public function __sleep()
    {
        $this->client->disconnect();
    }
}