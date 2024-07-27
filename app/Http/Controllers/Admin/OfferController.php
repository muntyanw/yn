<?php

namespace App\Http\Controllers\Admin;

use App\Models\Offer;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
   public function index()
   {
      $offers = Offer::with('skills')->paginate(10); // Загружаем связи skills
      return view('admin.offers.index', compact('offers'));
   }

   public function show($id)
   {
      $offer = Offer::findOrFail($id);
      return view('admin.offers.show', compact('offer'));
   }

   public function create()
   {
      $skills = Skill::all();
      return view('admin.offers.create', compact('skills'));
   }

   public function store(Request $request)
   {
      $request->validate([
         'title' => 'required|string|max:255',
         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
         'description' => 'nullable|string',
         'skills_type' => 'required|string|max:255',
         'vacancies' => 'required|integer|min:1',
         'is_active' => 'nullable|boolean',
      ]);

      $offer = new Offer();
      $offer->title = $request->input('title');
      $offer->description = $request->input('description');
      $offer->skills_type = $request->input('skills_type');
      $offer->vacancies = $request->input('vacancies');
      $offer->is_active = $request->input('is_active', true);

      if ($request->hasFile('image')) {
         $imagePath = $request->file('image')->store('offers', 'public');
         $offer->image = $imagePath;
      }

      $offer->save();

      $offer->skills()->sync($request->skills);

      return redirect()->route('admin_offers_index')->with('success', __('Offer created successfully.'));
   }

   public function edit($id)
   {
      $offer = Offer::findOrFail($id);
      $skills = Skill::all();
      return view('admin.offers.edit', compact('offer', 'skills'));
   }

   public function update(Request $request, $id)
   {
      $request->validate([
         'title' => 'required|string|max:255',
         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
         'description' => 'nullable|string',
         'skills_type' => 'required|string|max:255',
         'vacancies' => 'required|integer|min:1',
         'is_active' => 'string',
         'skills' => 'array'
      ]);

      $offer = Offer::findOrFail($id);
      $offer->title = $request->input('title');
      $offer->description = $request->input('description');
      $offer->skills_type = $request->input('skills_type');
      $offer->vacancies = $request->input('vacancies');
      $offer->is_active = $request->has('is_active') ? 1 : 0;

      if ($request->hasFile('image')) {
         if ($offer->image) {
            Storage::delete('public/' . $offer->image);
         }
         $imagePath = $request->file('image')->store('offers', 'public');
         $offer->image = $imagePath;
      }

      $offer->save();

      // Сохранение связей с скилами
      if ($request->has('skills')) {
         $offer->skills()->sync($request->input('skills'));
      } else {
         $offer->skills()->sync([]);
      }

      return redirect()->route('admin_offers_index')->with('success', __('Offer updated successfully.'));
   }

   public function destroy($id)
   {
      $offer = Offer::findOrFail($id);
      if ($offer->image) {
         Storage::delete('public/' . $offer->image);
      }
      $offer->delete();

      return redirect()->route('admin_offers_list')->with('success', __('Offer deleted successfully.'));
   }
}
