<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\News;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function home()
    {
        $news = News::orderBy('date', 'desc')->orderBy('time', 'desc')->take(3)->get();
        return view('guest.home', compact('news'));
    }

    public function aboutUs()
    {
        return view('guest.aboutus');
    }

    public function team()
    {
        return view('guest.team');
    }
}
