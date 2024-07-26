<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
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

    public function create()
    {
        return view('admin.volunteer.createVolunteer');
    }

    public function store(Request $request)
    {
        // Валидируем входящие данные
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:volunteers,email',
            'address' => 'required|string|max:500',
        ]);

        // Создаем новый волонтер
        $volunteer = new Volunteer();
        $volunteer->first_name = $request->input('first_name');
        $volunteer->middle_name = $request->input('middle_name');
        $volunteer->last_name = $request->input('last_name');
        $volunteer->phone = $request->input('phone');
        $volunteer->email = $request->input('email');
        $volunteer->address = $request->input('address');

        // Обрабатываем фото
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('volunteers', 'public');
            $volunteer->photo = $photoPath;
        }

        $volunteer->save();

        return redirect()->route('admin_volunteers_list')->with('success', __('Volunteer created successfully.'));
    }

    public function edit($id)
    {
        // Находим волонтера по ID
        $volunteer = Volunteer::findOrFail($id);

        // Возвращаем вид для редактирования волонтера с данными волонтера
        return view('admin.volunteer.editVolunteer', compact('volunteer'));
    }

    public function show($id)
    {
        // Найти волонтера по ID
        $volunteer = Volunteer::findOrFail($id);

        // Передать волонтера в вьюху
        return view('admin.volunteer.showVolunteer', compact('volunteer'));
    }

    public function update(Request $request, $id)
    {
        // Валидируем входящие данные
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:volunteers,email,' . $id,
            'address' => 'required|string|max:500',
        ]);

        // Находим волонтера по ID
        $volunteer = Volunteer::findOrFail($id);

        // Обновляем данные волонтера
        $volunteer->first_name = $request->input('first_name');
        $volunteer->middle_name = $request->input('middle_name');
        $volunteer->last_name = $request->input('last_name');
        $volunteer->phone = $request->input('phone');
        $volunteer->email = $request->input('email');
        $volunteer->address = $request->input('address');

        // Обрабатываем новое фото
        if ($request->hasFile('photo')) {
            // Удаляем старое фото
            if ($volunteer->photo) {
                Storage::disk('public')->delete($volunteer->photo);
            }

            $photoPath = $request->file('photo')->store('volunteers', 'public');
            $volunteer->photo = $photoPath;
        }

        $volunteer->save();

        return redirect()->route('admin_volunteers_list')->with('success', __('Volunteer updated successfully.'));
    }

    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();
        return redirect()->route('admin_volunteers_list')->with('success', __('Volunteer deleted successfully.'));
    }
}
