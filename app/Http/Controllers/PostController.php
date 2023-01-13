<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // https://laravel.com/docs/7.x/controllers#resource-controllers - тут можно посмотреть таблицу как нам попадать на разные методы данного класса

    public function __construct(Request $request)
    {
        dump($request->route()->getName()); // получаем название маршрута
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // Этот метод отвечает за показ о списках ресурсов
    {
        return view('posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() // показывает форму для создания нового ресурса
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // сохраняет новый ресурс в БД
    {
        dd($request); // показываем данные и завершаем работу скрипта
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // показывает ресурс по ид
    {
        return "Post $id";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // показывает форму для редактирования ресурсов; $id мы получаем из вида когда передаем параметры для маршрута, в нашем случае $id = slug из вида
    {
        return view('posts.edit', ['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // обновляет ресурс
    {
        dump($id);
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) // удаляет ресурс
    {
        dump(__METHOD__);
        dd($id);
    }
}
