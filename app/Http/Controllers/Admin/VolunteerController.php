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
        $volunteers = Volunteer::all();
        return view('volunteers.index', compact('volunteers'));
    }

    public function list()
    {
        // Получаем волонтеров с пагинацией по 20 элементов на страницу
        $volunteers = Volunteer::paginate(20);
        return view('admin.volunteer.listVolunteers', compact('volunteers'));
    }

    public function create($user_id)
    {
        $user = $user_id ? User::findOrFail($user_id) : null;
        return view('admin.volunteer.createVolunteer', compact('user'));
    }

    public function store(Request $request)
    {
        // Валидируем входящие данные
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
            'user_id' => 'required|exists:users,id' // Добавляем правило для user_id
        ]);

        // Retrieve the user based on user_id
        $user = User::find($request->input('user_id'));

        // Check if a volunteer already exists for this user
        if ($user->volunteer) {
            return redirect()->back()->withErrors(['user_id' => __('This user already has a volunteer record.')]);
        }

        // Создаем новый объект волонтера и связываем его с пользователем
        $volunteer = Volunteer::create(array_merge(
            $request->only([
                'first_name',
                'middle_name',
                'last_name',
                'phone',
                'email',
                'address',
            ]),
            ['user_id' => $request->input('user_id')]
        ));

        // Сохраняем фото, если оно было загружено
        if ($request->hasFile('photo')) {
            $volunteer->photo = $request->file('photo')->store('volunteers', 'public');
            $volunteer->save();
        }

        $user = User::find($request->input('user_id'));
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
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string',
            'skills' => 'nullable|array',  // <-- Добавьте это правило
            'skills.*' => 'exists:skills,id',  // <-- Убедитесь, что скиллы существуют
        ]);

        $volunteer = Volunteer::findOrFail($id);
        $volunteer->fill($request->only([
            'first_name',
            'middle_name',
            'last_name',
            'phone',
            'email',
            'address',
        ]));

        if ($request->hasFile('photo')) {
            if ($volunteer->photo) {
                Storage::delete('public/' . $volunteer->photo);
            }
            $volunteer->photo = $request->file('photo')->store('volunteers', 'public');
        }

        $volunteer->save();
        $volunteer->skills()->sync($request->input('skills', []));

        return redirect()->route('admin_volunteers_index')->with('success', __('Volunteer updated successfully.'));
    }

    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();
        return redirect()->route('admin_volunteers_index')->with('success', __('Volunteer deleted successfully.'));
    }
}
