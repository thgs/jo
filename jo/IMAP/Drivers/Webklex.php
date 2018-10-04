<?php

use Webklex\IMAP\Client;
use Jo\IMAP\Drivers\JoImapDriver;

class Webklex extends BaseDriver implements JoImapDriver
{
	public function boot()
	{
		$this->setClient(new Client([
            'host'          => $this->account->host,
            'port'          => $this->account->port,
            'encryption'    => $this->account->encryption,
            'validate_cert' => true,
            'username'      => $this->account->username,
            'password'      => $this->account->password,
            'protocol'      => $this->account->protocol,
        ]));
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
}