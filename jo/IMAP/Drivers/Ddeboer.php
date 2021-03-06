<?php

namespace Jo\IMAP\Drivers;

use Ddeboer\Imap\Server;
use Ddeboer\Imap\SearchExpression;
use Ddeboer\Imap\Search\State\NewMessage;
use Jo\IMAP\Data\FoldersList;

class Ddeboer extends BaseDriver implements JoImapDriver
{
	protected $server;

	public $defaultParams = null;

	public function boot()
	{

		$this->server = new Server(
    		$this->account->host, 	// required
			$this->account->port     // defaults to '993'
		);

		/*
    		true,    // defaults to '/imap/ssl/validate-cert'
    		[]	// as https://secure.php.net/manual/en/function.imap-open.php
		);
		*/
		
		// here we will set the client to be what Ddeboer says connection
		$this->setClient(
			$this->server->authenticate(
				$this->account->username, 
				$this->account->password
			)
		);
	}

	public function connect()
	{
		return $this->client;
	}

	public function getFolders()
	{
		return new FoldersList($this->client->getMailboxes());
	}

	public function getUnseenMessages($folder = 'INBOX', $criteria = 'unseen')
	{
		//todo: here could be a little more DRY really..
		$mailbox = $this->client->getMailbox($folder);

		$search = new SearchExpression();
		$search->addCondition(new NewMessage);

		return $mailbox->getMessages($searchExpression);
	}

	public function getFolderMessages($folder = 'INBOX', $criteria = 'all')
	{
		$mailbox = $this->client->getMailbox($folder);

		return $mailbox->getMessages();
	}
}