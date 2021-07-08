<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        #dd(auth()->user());
        #dd(auth()->user()->posts);

        #dd(Post::find(2));
        return view('dashboard');
    }
}
