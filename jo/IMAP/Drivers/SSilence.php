<?php

namespace Jo\IMAP\Drivers;

use SSilence\ImapClient\ImapClient;
use SSilence\ImapClient\ImapConnect;

class SSilence extends BaseDriver implements JoImapDriver
{
	public function boot()
	{
		$this->client = new ImapClient([
		    'flags' => [
		        'service' => ImapConnect::SERVICE_IMAP,
		        'encrypt' => ImapConnect::ENCRYPT_SSL,
		        'validateCertificates' => ImapConnect::VALIDATE_CERT,
		        // Turns debug on or off
		        'debug' => null,
		    ],
		    'mailbox' => [
	    	    'remote_system_name' => $this->account->host,
	        	'port' => $this->account->host,
		    ],
	    	'connect' => [
	        	'username' => $this->account->username,
	        	'password' => $this->account->password
	    	]
		]);

	}

	public function getFolders()
	{
		return $this->client->getFolders();
	}

	public function getUnseenMessages($folder = 'INBOX', $criteria = 'unseen')
	{
		$this->client->selectFolder($folder);

		return $this->client->getUnreadMessages();
	}

	public function getFolderMessages($folder = 'INBOX', $criteria = 'all')
	{
		$this->client->selectFolder($folder);

		return $this->client->getMessages();
	}
}