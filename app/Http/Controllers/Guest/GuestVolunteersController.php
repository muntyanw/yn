<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Http\Controllers\Controller;

class GuestVolunteersController extends Controller
{

    public function index()
    {
        $volunteers = Volunteer::limit(6)->get();
        return view('guest.volunteers', compact('volunteers'));
    }


    public function fetchVolunteers(Request $request)
    {
        $offset = $request->get('offset', 0);
        $volunteers = Volunteer::offset($offset)->limit(6)->get();

        return response()->json($volunteers);
    }
}
