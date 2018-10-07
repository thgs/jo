<?php

namespace Jo\IMAP\Drivers;

use PhpImap\Mailbox;

class PhpImap extends BaseDriver implements JoImapDriver
{
	public function boot()
	{
		$this->setClient(
			new Mailbox(
				sprintf('{%s:%s/imap/ssl}INBOX', $this->account->host, $this->account->port),
				$this->account->username,
				$this->account->password,
				storage_path()		// save attachments dir
			)
		);
	}

	public function connect()
	{
		return $this->client;
	}

	public function getFolders()
	{
		dd(
		$this->client->getListingFolders()
		);
	}

	public function getUnseenMessages($folder = 'INBOX', $criteria = 'unseen')
	{
		return $this->getFolderMessages($folder, 'new');
	}

	public function getFolderMessages($folder = 'INBOX', $criteria = 'all')
	{
		$this->client->switchMailbox($folder);
		
		return $this->client->searchMailbox(strtoupper($criteria));
	}
}