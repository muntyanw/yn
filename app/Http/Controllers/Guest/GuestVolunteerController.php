<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Offer;
use App\Services\VolunteerService;

class GuestVolunteerController extends Controller
{
    protected $volunteerService;

    public function __construct(VolunteerService $volunteerService)
    {
        $this->volunteerService = $volunteerService;
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ];

        Mail::to("pounitednation@gmail.com")->send(new \App\Mail\ContactMail($details));

        return back()->with('success', 'Ваше сообщение было успешно отправлено!');
    }
    
    public function index()
    {
        // Retrieve active offers with related skills and time periods
        $offers = Offer::with(['skills', 'timePeriods'])
            ->where('is_active', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        $volunteers = $this->volunteerService->fetchVolunteers(0, 8, false, true);

        // Pass the offers to the view
        return view('guest.offers', compact('offers', 'volunteers'));
    }

    public function fetchVolunteers(Request $request)
    {

        $offset = $request->get('offset', 0);
        $volunteers = $this->volunteerService->fetchVolunteers($offset, 8, false, true);

        return response()->json($volunteers);
    }

    public function volunteerHelp($offer_id)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            session(['offer_id' => $offer_id]);
            return redirect()->route('guest_volunteer_want_help_form');
        }

        $user = User::find(auth()->id());
        $volunteer = $user->volunteer;

        // Retrieve the offer
        $offer = Offer::findOrFail($offer_id);

        // Attach the skills associated with the offer to the user
        foreach ($offer->skills as $skill) {
            if (!$volunteer->skills()->pluck('skill_id')->contains($skill->id)) {
                $volunteer->skills()->attach($skill->id);
            }
        }

        // Redirect to the dashboard or any other intended page
        return redirect()->route('dashboard')->with('success', 'You have successfully signed up to help with the offer.');
    }

    public function wantBecome()
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            session(['want-become' => true]);
        }
        return redirect()->route('dashboard');
    }
}
