<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use Jo\Resources\RController;
use Jo\IMAP\ImapRepository;
use Jo\Resources\Repos\EmailAccountsRepo;

class EmailAccountsController extends RController
{
    protected $emailsRepo;

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

        $imapRepo = new ImapRepository($emailAccount);

        // old code
        //$messages = $imapRepo->getUnseenMessages();

        // retrieving messages from db..
        $messages = Email::where('mailbox', 'INBOX')->get();

        return view('emailaccounts.view_from_model', [
            'account' => $emailAccount,
            'folders' => $imapRepo->getFolders(),
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
