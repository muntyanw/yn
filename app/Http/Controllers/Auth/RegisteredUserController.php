<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Volunteer;
use App\Models\VolunteerFile;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register-volunteer');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeOnlyUser(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('user');

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function store(Request $request): RedirectResponse
    {
        // Валидация данных пользователя и волонтера
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'about_me' => ['nullable', 'string'],
            'public_access' => ['required'],
            'files.*' => ['nullable', 'file', 'max:10240'],
        ]);

        // Создание пользователя
        $user = User::create([
            'name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Присвоение роли пользователю
        $user->assignRole('user');

        // Создание волонтера
        $volunteer = Volunteer::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email, // Используем email пользователя
            'address' => $request->address,
            'about_me' => $request->about_me,
            'is_employee' => $request->has('is_employee') ?? false,
            'public_access' => $request->has('public_access'),
        ]);

        // Сохранение фотографии, если она загружена
        if ($request->hasFile('photo')) {
            $volunteer->update([
                'photo' => asset('storage/' . $request->file('photo')->store('volunteer_photos', 'public')),
            ]);
        }

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

        // Присвоение роли пользователю
        $user->assignRole('volunteer');


        // Генерация события о регистрации
        event(new Registered($user));

        // Авторизация пользователя
        Auth::login($user);

        // Перенаправление на панель управления
        return redirect(route('dashboard', absolute: false));
    }
}
