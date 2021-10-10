<?php
namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Mail\PostLiked;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $user = auth()->user();

        return view('dashboard');
    }
}
