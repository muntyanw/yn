<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function home()
    {
        return view('guest.home');
    }

    public function aboutUs()
    {
        return view('guest.aboutus');
    }
}
