<?php

namespace App\Http\Controllers;

use Webklex\IMAP\Client;
use Illuminate\Http\Request;
use Jo\Resources\RController;
use Jo\Resources\Repos\EmailAccountsRepo;

class EmailAccountsController extends RController
{
    public function __construct(EmailAccountsRepo $repo)
    {
        $this->setRepo($repo);
        $this->setViewsDir('emailaccounts');
    }

    // Overrides ---------------------------

    public function index()
    {
        return redirect('home');
    }


    // Controller methods


    /**
     * View emails of a given account
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $emailAccount = $this->repo->findOrFail($id);

        // get client instance
        $client = new Client([
            'host'          => $emailAccount->host,
            'port'          => $emailAccount->port,
            'encryption'    => $emailAccount->encryption,
            'validate_cert' => true,
            'username'      => $emailAccount->username,
            'password'      => $emailAccount->password,
            'protocol'      => $emailAccount->protocol,
        ]);

        //Connect to the IMAP Server
        $client->connect();

        //Get all Mailboxes
        /** @var \Webklex\IMAP\Support\FolderCollection $aFolder */
        $folders = $client->getFolders(true);

        // get inbox messages
        $inbox = $client->getFolder('INBOX');
        $messages = $inbox->query()
            ->whereAll()
            ->setFetchFlags(false)
            ->setFetchBody(false)
            ->setFetchAttachment(false)
            ->limit(20, 1)
            ->get();


        return view('emailaccounts.view', [
            'account' => $emailAccount,
            'folders' => $folders,
            'messages' => $messages,
        ]);
    }


    /**
     * Delete the given account
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        return redirect()->back();
    }

}
