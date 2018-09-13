<?php

namespace Jo\Synchronisation;

use Jo\Resources\Repos\EmailsRepo;
use Jo\Resources\Repos\ImapRepository;
use Jo\Resources\Repos\EmailAccountsRepo;

class EmailsSynchroniser
{

    protected $emailsRepo;
    protected $emailAccountsRepo;

    public function __construct(EmailsRepo $emailsRepo, EmailAccountsRepo $repo)
    {
        $this->emailsRepo = $emailsRepo;
        $this->emailAccountsRepo = $repo;
    }

    public function syncAll()
    {
        $accounts = $this->emailAccountsRepo->getAccountsToSync();

        foreach ($accounts as $account)
        {
            $imapRepo = new ImapRepository($account);

            $newMessages = $imapRepo->getUnseenMessages();

            // let's not handle real synchronisation, for now it will be
            // okay, just store the unseen
            $this->emailsRepo->storeBulkFromImap($newMessages);

            // update the account, saying we have synced
            $account->touch();
        }

    }
}
