<?php

namespace Jo\IMAP\Drivers;

class PhpImapDriver extends BaseDriver implements JoImapDriver
{
	public function boot()
	{
		$this->setClient(new Client([
            'host'          => $account->host,
            'port'          => $account->port,
            'encryption'    => $account->encryption,
            'validate_cert' => true,
            'username'      => $account->username,
            'password'      => $account->password,
            'protocol'      => $account->protocol,
        ]));
	}

	public function getFolders()
	{

	}

	public function getUnseenMessages($folder = 'INBOX', $criteria = 'unseen')
	{

	}

	public function getFolderMessages($folder = 'INBOX', $criteria = 'all')
	{
		
	}
}