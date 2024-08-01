<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Volunteer;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VolunteerController extends Controller
{
    public function index()
    {
        $volunteers = Volunteer::paginate(20);
        return view('admin.volunteer.listVolunteers', compact('volunteers'));
    }

    public function create($user_id)
    {
        $user = $user_id ? User::findOrFail($user_id) : null;
        $skills = Skill::all();
        return view('admin.volunteer.createVolunteer', compact('user', 'skills'));
    }

    public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'photo_url' => 'nullable|url',
        'phone' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'address' => 'nullable|string',
        'skills' => 'nullable|array',
        'skills.*' => 'exists:skills,id',
        'about_me' => 'nullable|string',
        'is_employee' => 'nullable|string',
        'public_access' => 'nullable|string',
        'user_id' => 'required|exists:users,id'
    ]);

    $user = User::find($request->input('user_id'));

    if ($user->volunteer) {
        return redirect()->back()->withErrors(['user_id' => __('This user already has a volunteer record.')]);
    }

    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photoPath = "storage/" . $request->file('photo')->store('volunteers_photos', 'public');
    } elseif ($request->input('photo_url')) {
        $photoPath = $request->input('photo_url');
    }

    // Создаем новый объект волонтера и присваиваем значения свойствам
    $volunteer = new Volunteer();
    $volunteer->first_name = $request->input('first_name');
    $volunteer->middle_name = $request->input('middle_name');
    $volunteer->last_name = $request->input('last_name');
    $volunteer->phone = $request->input('phone');
    $volunteer->email = $request->input('email');
    $volunteer->address = $request->input('address');
    $volunteer->about_me = $request->input('about_me');
    $volunteer->is_employee = $request->input('is_employee') === 'on';
    $volunteer->public_access = $request->input('public_access') === 'on';
    $volunteer->photo = $photoPath;
    $volunteer->user_id = $request->input('user_id');

    // Сохраняем объект волонтера
    $volunteer->save();

    $user->assignRole('volunteer');

    // Привязываем выбранные скиллы
    $volunteer->skills()->sync($request->input('skills', []));

    return redirect()->route('admin_volunteers_index')->with('success', __('Volunteer created successfully.'));
}


    public function edit($id)
    {
        $volunteer = Volunteer::with('skills')->findOrFail($id);
        $skills = Skill::all();

        return view('admin.volunteer.editVolunteer', compact('volunteer', 'skills'));
    }

    public function show($id)
    {
        $volunteer = Volunteer::with('user')->findOrFail($id);
        return view('admin.volunteer.showVolunteer', compact('volunteer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_url' => 'nullable|url',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
            'about_me' => 'nullable|string',
            'is_employee' => 'nullable|string',
            'public_access' => 'nullable|string',
        ]);
    
        $volunteer = Volunteer::findOrFail($id);
    
        // Присваиваем значения свойствам объекта волонтера
        $volunteer->first_name = $request->input('first_name');
        $volunteer->middle_name = $request->input('middle_name');
        $volunteer->last_name = $request->input('last_name');
        $volunteer->phone = $request->input('phone');
        $volunteer->email = $request->input('email');
        $volunteer->address = $request->input('address');
        $volunteer->about_me = $request->input('about_me');
        $volunteer->is_employee = $request->input('is_employee') === 'on';
        $volunteer->public_access = $request->input('public_access') === 'on';
    
        $photoPath = $volunteer->photo;
        if ($request->hasFile('photo')) {
            if ($volunteer->photo) {
                Storage::disk('public')->delete($volunteer->photo);
            }
            $photoPath = "storage/" . $request->file('photo')->store('volunteers_photos', 'public');
        } elseif ($request->input('photo_url')) {
            $photoPath = $request->input('photo_url');
        }
    
        $volunteer->photo = $photoPath;
    
        // Сохраняем объект волонтера
        $volunteer->save();
    
        // Привязываем выбранные скиллы
        $volunteer->skills()->sync($request->input('skills', []));
    
        return redirect()->route('admin_volunteers_index')->with('success', __('Volunteer updated successfully.'));
    }
    

    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();
        return redirect()->route('admin_volunteers_index')->with('success', __('Volunteer deleted successfully.'));
    }
}
