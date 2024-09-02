<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Http\Controllers\Controller;
use App\Services\VolunteerService;

class TeamController extends Controller
{
   
    protected $volunteerService;

    public function __construct(VolunteerService $volunteerService)
    {
        $this->volunteerService = $volunteerService;
    }

    public function index()
    {
        $volunteers = $this->volunteerService->fetchVolunteers(0, 6, true, true);
        return view('guest.volunteer.volunteers', compact('volunteers'));
    }


    public function showEmployee($id)
    {
        $volunteer = Volunteer::with('skills')->findOrFail($id);
        return view('guest.volunteer.showEmployee', compact('volunteer'));
    }

    public function showVolunteer($id)
    {
        $volunteer = Volunteer::with('skills')->findOrFail($id);
        return view('guest.volunteer.showVolunteer', compact('volunteer'));
    }

    public function fetchTeam(Request $request)
    {
        $offset = $request->get('offset', 0);
        $volunteers = $this->volunteerService->fetchVolunteers($offset, 6, true, true);

        return response()->json($volunteers);
    }
}
