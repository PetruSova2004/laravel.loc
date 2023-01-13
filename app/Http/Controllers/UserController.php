<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users', // unique:users - проверяет если в таблице users уже нет такого адреса
            'password' => 'required|confirmed', // confirmed мы указываем для поля которое ниже находиться под паролем, чтобы всё сработало в name данного поля должно присутствовать('_confirmation').
            'avatar' => 'nullable|image' // image - должно быть провалидировано как картинка
        ]);

        if ($request->hasFile('avatar')) { // если пользователь прикрепил картинку при регистрации
            $folder = date('Y-m-d'); // текущая дата
            $avatar = $request->file('avatar')->store("images/{$folder}"); // в store указываем куда сохранять картинку; сохраним картинку под названием сегодняшней даты
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $avatar ?? null,
        ]);

        session()->flash('success', 'Successful registration');
        Auth::login($user); // после успешной регистрации мы сразу логируем пользователя
        return redirect()->home();
    }

    public function loginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([ // attempt() отвечает за аутентификацию пользователя
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->home(); // если мы прошли логирование
        }

        return redirect()->back()->with('error', 'Incorrect login or password'); // back() - вернет пользователя на предыдущею страницу; в with() - мы записываем данные в flash сессию которая после обновления страницы пропадёт
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }

}
