<?php

namespace App\Http\Controllers;

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


}
