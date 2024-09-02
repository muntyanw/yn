<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\VolunteerFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $volunteer = $user->volunteer; // Предполагается, что существует связь между пользователем и волонтером

        return view('user.profile.edit', [
            'user' => $user,
            'volunteer' => $volunteer,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function updateOld(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Обновление данных пользователя
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        // Обновление данных волонтера
        $volunteer = $request->user()->volunteer;

        if ($volunteer) {
            $volunteer->update([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'about_me' => $request->about_me,
                'is_employee' => $request->has('is_employee'),
                'public_access' => $request->has('public_access'),
            ]);

            // Сохранение нового фото (если загружено)
            if ($request->hasFile('photo')) {
                // Удаление старого фото, если оно существует
                if ($volunteer->photo) {
                    Storage::disk('public')->delete($volunteer->photo);
                }

                // Сохранение нового фото с оригинальным именем
                $photoName = $request->file('photo')->getClientOriginalName();
                $volunteer->photo = asset('storage/' . $request->file('photo')->storeAs('volunteer_photos', $photoName, 'public'));
                $volunteer->save();
            }

            // Сохранение новых файлов с оригинальными именами
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $fileName = $file->getClientOriginalName();
                    $path = $file->storeAs('volunteer_files', $fileName, 'public');
                    VolunteerFile::create([
                        'volunteer_id' => $volunteer->id,
                        'file_path' => $path,
                        'file_name' => $fileName,
                    ]);
                }
            }
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function deleteFile($id): JsonResponse
    {
        $file = VolunteerFile::findOrFail($id);
    
        // Удалить файл из файловой системы
        if (Storage::disk('public')->exists($file->file_path)) {
            Storage::disk('public')->delete($file->file_path);
        }
    
        // Удалить запись о файле из базы данных
        $file->delete();
    
        return response()->json(['message' => __('File deleted successfully.')]);
    }
    
}
