<?php

namespace App\Http\Controllers\Admin;

use App\Models\VolunteerFile;
use App\Models\User;
use App\Models\Volunteer;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VolunteerController extends AdminBaseController
{
    public function index()
    {
        $volunteers = Volunteer::paginate(20);
        $volunteers->getCollection()->transform(function ($volunteer) {
            $volunteer->about_me = strlen($volunteer->about_me) > 30 ? substr($volunteer->about_me, 0, 30) . '...' : $volunteer->about_me;
            return $volunteer;
        });

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
            'photo_url' => 'nullable|string',
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
            $originalName = $request->file('photo')->getClientOriginalName();
            $photoPath = asset('storage/' . $request->file('photo')->storeAs('volunteers_photos', $originalName, 'public'));
        } elseif ($request->input('photo_url')) {
            $photoPath = $request->input('photo_url');
        }

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

        $volunteer->save();

        $user->assignRole('volunteer');

        $volunteer->skills()->sync($request->input('skills', []));

        // Сохранение файлов
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $nameFile = $file->getClientOriginalName();
                $path = $file->storeAs('volunteer_files', $nameFile, 'public');
                VolunteerFile::create([
                    'volunteer_id' => $volunteer->id,
                    'file_path' => $path,
                    'file_name' => $nameFile,
                ]);
            }
        }

        return redirect()->route('admin_volunteers_index')->with('success', __('Volunteer created successfully.'));
    }

    public function edit($id)
    {
        $volunteer = Volunteer::with('skills')->with('files')->findOrFail($id);
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
            'photo_url' => 'nullable|string',
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
            $originalName = $request->file('photo')->getClientOriginalName();
            $photoPath = asset('storage/' . $request->file('photo')->storeAs('volunteers_photos', $originalName, 'public'));
        } elseif ($request->input('photo_url')) {
            $photoPath = $request->input('photo_url');
        } elseif ($request->input('current_photo_remove') == 'true') {
            $photoPath = "";
        }

        $volunteer->photo = $photoPath;

        $volunteer->save();

        $volunteer->skills()->sync($request->input('skills', []));

        // Сохранение файлов
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $nameFile = $file->getClientOriginalName();
                $path = $file->storeAs('volunteer_files', $nameFile, 'public');
                VolunteerFile::create([
                    'volunteer_id' => $volunteer->id,
                    'file_path' => $path,
                    'file_name' => $nameFile,
                ]);
            }
        }

        return redirect()->route('admin_volunteers_index')->with('success', __('Volunteer updated successfully.'));
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:volunteers,id'],
        ]);

        $volunteer = Volunteer::findOrFail($request->id);
        $volunteer->delete();

        return redirect()->route('admin_volunteers_index')->with('success', __('Volunteer deleted successfully.'));
    }

    public function downloadFile($id)
    {
        $file = VolunteerFile::findOrFail($id);
        $filePath = storage_path('app/public/' . $file->file_path);

        if (file_exists($filePath)) {
            return response()->download($filePath, $file->file_name);
        }

        return redirect()->back()->with('error', __('File not found.'));
    }

    public function downloadFilePath($filePath)
    {
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        return redirect()->back()->with('error', __('File not found.'));
    }

    public function deleteFile($id)
    {
        $file = VolunteerFile::findOrFail($id);
        $filePath = storage_path('app/public/' . $file->file_path);

        if (file_exists($filePath)) {
            unlink($filePath); // Удаление файла из файловой системы
        }

        $file->delete(); // Удаление записи о файле из базы данных

        return redirect()->back()->with('success', __('File deleted successfully.'));
    }
}
