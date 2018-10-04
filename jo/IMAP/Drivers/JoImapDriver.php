<?php

namespace Jo\IMAP\Drivers;

interface JoImapDriver
{
	public function connect();

	public function disconnect();

	public function boot();

	public function getFolders();

	public function getUnseenMessages($folder = 'INBOX', $criteria = 'unseen');

	public function getFolderMessages($folder = 'INBOX', $criteria = 'all');
}