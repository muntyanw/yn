<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{

    public function index()
    {
        $volunteers = Volunteer::limit(6)->get();
        return view('guest.volunteer.volunteers', compact('volunteers'));
    }


    public function fetchVolunteers(Request $request)
{
    $offset = $request->get('offset', 0);
    $volunteers = Volunteer::where('public_access', true)
                           ->offset($offset)
                           ->limit(6)
                           ->get();

    return response()->json($volunteers);
}


    public function show($id)
    {
        $volunteer = Volunteer::with('skills')->findOrFail($id);
        return view('guest.volunteer.show', compact('volunteer'));
    }
}
