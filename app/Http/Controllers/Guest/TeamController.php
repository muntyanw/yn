<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;


class TeamController extends Controller
{
   public function index()
   {
       return view('guest.team');
   }
}
