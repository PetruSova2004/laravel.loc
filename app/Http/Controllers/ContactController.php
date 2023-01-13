<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        if ($request->method() == 'POST') { // если был отправлен запрос методом POST
            $this->validate($request, [
                'name' => 'required|min:5|max:100',
                'email' => 'required',
            ]);
//      в $body будет то что получит пользователь в письме
            $body = "<p><b>Имя:</b> {$request->input('name')}</p>";
            $body .= "<p><b>E-mail:</b> {$request->input('email')}</p>";
            $body .= "<p><b>Сообщение:</b><br>" . nl2br($request->input('text')) . "</p>";
            Mail::to('nicupetru@mail.ru')->send(new TestMail($body)); // создаем экземпляр данного класса, указываем для "заглушки" куда будет отправлено письмо, отправляем данное письмо, передаем $body в конструктор класса TestMail
            $request->session()->flash('success', 'Сообщение отправлено.');
            return redirect('/send');
        }
        return view('send');
    }

}
