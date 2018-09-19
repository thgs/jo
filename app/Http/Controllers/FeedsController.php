<?php

namespace App\Http\Controllers;

use Jo\GuzzleClient;
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
     * View posts of the given feed
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
     * Delete the given feed
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        return redirect()->back();
    }


    /**
     * Refreshes a feed
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh($id)
    {
        $feed = $this->repo->findOrFail($id);

        return view('feeds.view', [
            'feed' => $feed,
            'items' => $feed->posts
        ]);

    }

}
