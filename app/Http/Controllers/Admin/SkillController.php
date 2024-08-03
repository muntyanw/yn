<?php

// app/Http/Controllers/Admin/SkillController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends AdminBaseController
{
   public function index()
   {
      $skills = Skill::paginate(10);
      return view('admin.skills.index', compact('skills'));
   }

   public function create()
   {
      return view('admin.skills.create');
   }

   public function store(Request $request)
   {
      $request->validate([
         'name' => 'required|string|max:255',
         'description' => 'nullable|string',
      ]);

      Skill::create($request->all());

      return redirect()->route('admin_skills_list')->with('success', __('Skill created successfully.'));
   }

   public function edit(Skill $skill)
   {
      return view('admin.skills.edit', compact('skill'));
   }

   public function update(Request $request, Skill $skill)
   {
      $request->validate([
         'name' => 'required|string|max:255',
         'description' => 'nullable|string',
      ]);

      $skill->update($request->all());

      return redirect()->route('admin_skills_list')->with('success', __('Skill updated successfully.'));
   }

   public function destroy(Skill $skill)
   {
      $skill->delete();
      return redirect()->route('admin_skills_list')->with('success', __('Skill deleted successfully.'));
   }
}
