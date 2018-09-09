<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jo\Resources\RController;
use Jo\Resources\Repos\FeedsRepo;

class FeedsController extends RController
{
    public function __construct(FeedsRepo $repo)
    {
        $this->setRepo($repo);
        $this->setViewsDir('feeds');
    }

    // Overrides ---------------------------

    public function index()
    {
        return view('feeds.index', [
            'feeds' => $this->repo->all()
        ]);
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

        return view('emailaccounts.view', [
            'account' => $emailAccount,
            'folders' => $imapRepo->getFolders(),
            'messages' => $imapRepo->getUnseenMessages(),
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
