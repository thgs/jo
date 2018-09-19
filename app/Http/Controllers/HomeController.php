<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Feed;
use App\Models\Email;
use App\Models\EmailAccount;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', [
            'feeds' => Feed::all(),
            'postsCount' => Post::all()->count(),
            'emailAccounts' => EmailAccount::all(),
            'emailsCount' => Email::all()->count(),
        ]);
    }
}
