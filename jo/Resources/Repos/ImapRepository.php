<?php

namespace Jo\Resources\Repos;

use Webklex\IMAP\Client;
use App\Models\EmailAccount;

class ImapRepository
{
    protected $client;

    public function __construct(EmailAccount $account)
    {
        // get client instance
        $this->client = new Client([
            'host'          => $account->host,
            'port'          => $account->port,
            'encryption'    => $account->encryption,
            'validate_cert' => true,
            'username'      => $account->username,
            'password'      => $account->password,
            'protocol'      => $account->protocol,
        ]);

        //Connect to the IMAP Server
        $this->client->connect();
    }

    public function getFolders()
    {
        //Get all Mailboxes
        /** @var \Webklex\IMAP\Support\FolderCollection $aFolder */
        return $this->client->getFolders(true);
    }


    public function getUnseenMessages($folder = 'INBOX', $criteria = 'unseen')
    {
        // get inbox messages
        $inbox = $this->client->getFolder($folder);
        return $this->client->getUnseenMessages(
            $inbox,
            $criteria,
            false,
            false,
            true
        );
    }

    public function getFolderMessages($folder = 'INBOX', $criteria = 'all')
    {
        $folder = $this->client->getFolder($folder);
        return $this->client->getMessages(
            $folder,
            $criteria,
            false,
            false,
            true
        );
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
