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


    public function getUnseenMessages()
    {
        // get inbox messages
        $inbox = $this->client->getFolder('INBOX');
        return $this->client->getUnseenMessages(
            $inbox,
            'unseen',
            false,
            false,
            true
        );
    }
}
