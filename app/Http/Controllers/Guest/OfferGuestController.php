<?php

namespace App\Http\Controllers\Guest;

use App\Models\Offer;
use App\Models\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfferGuestController extends Controller
{

   public function index()
   {
      // Retrieve active offers with related skills and time periods
      $offers = Offer::with(['skills', 'timePeriods'])->where('is_active', true)->get();

      // Pass the offers to the view
      return view('guest.offers', compact('offers'));
   }


   public function volunteerHelp(Request $request, $offer_id)
   {
      // Check if the user is authenticated
      if (!auth()->check()) {
         session(['offer_id' => $offer_id]);
         return redirect()->route('login');
      }

      $user = auth()->user();

      // Retrieve the offer
      $offer = Offer::findOrFail($offer_id);

      // Attach the skills associated with the offer to the user
      foreach ($offer->skills as $skill) {
         if (!$user->skills->contains($skill->id)) {
            $user->volunteer()->skills()->attach($skill->id);
         }
      }

      // Redirect to the dashboard or any other intended page
      return redirect()->route('dashboard')->with('success', 'You have successfully signed up to help with the offer.');
   }
}
