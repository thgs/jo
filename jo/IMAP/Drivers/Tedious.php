<?php

namespace Jo\IMAP\Drivers;

use Fetch\Server;

class Tedious extends BaseDriver implements JoImapDriver
{
	public function boot()
	{
		// here we call the Server a client :D
		$this->client = new Server(
			$this->account->host, 
			$this->account->port
		);

		$this->client->setAuthentication(
			$this->account->username, 
			$this->account->password
		);
	}

	public function getFolders()
	{
		return $this->client->listMailBoxes();
	}

	public function getUnseenMessages($folder = 'INBOX', $criteria = 'unseen')
	{
		$this->client->setMailbox($folder);

		return $this->client->getMessages();
	}

	public function getFolderMessages($folder = 'INBOX', $criteria = 'all')
	{
		$this->client->setMailbox($folder);

		return $this->client->getMessages();
	}
}