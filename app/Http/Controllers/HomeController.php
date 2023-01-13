<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Post;
use App\Rubric;
use App\Tag;
use Illuminate\Http\Request;
use App\Xamp;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index(Request $request)
    {
//        $data = Country::all();
//        $data = Country::query()->limit(5)->get();
//        $data = Country::where('Code', '<', 'ALB')->select('Code', 'Name')->offset(1)->limit(2)->get(); // в offset указываем сколько записей пропустить
//        $data = City::find(5);
//        $data = Country::find('AGO2');
//        dd($data);

        /*$post = new Post();
        $post->title = 'Post 4';
        $post->content = 'Lorem ipsum 4';
        $post->save();*/

//      Post::create(['title' => 'Post 5', 'content' => 'Lorem ipsum 5']);
        /*$post = new Post();
        $post->fill(['title' => 'Post 8', 'content' => 'Lorem ipsum 8']);
        $post->save();*/

        /*$post = Post::find(6); // получаем запись с номером 6
        $post->content = 'Lorem ipsum 6';
        $post->save();*/

//        Post::where('id', '>', 3)
//            ->update(['updated_at' => NOW()]);

//        $post = Post::find(7);
//        $post->delete();

//        Post::destroy(4, 5, 6); // удаляем записи по id


        /*$post = Post::find(3);
        dump($post->title, $post->rubric->title);*/
        /*$rubric = Rubric::find(3);
        dump($rubric->title, $rubric->post->title);*/

//        $rubric = Rubric::find(1);
//        dump($rubric->posts); // получаем Посты, которые привязанные к указанной Рубрике

        /*$posts = Rubric::find(1)->posts()->select('title')->where('id', '>', '2')->get();
                dump($posts);*/

        /*$posts = Post::with('rubric')->where('id', '>', 1)->get();
        foreach ($posts as $post) {
            dump($post->title, $post->rubric->title);
        }*/

//        $post = Post::find(1);
//        dump($post->title);
//        foreach ($post->tags as $tag) { // получаем теги, которые привязанные к данному посту
//            dump($tag->title);
//        }

        /*$tag = Tag::find(3);
        dump($tag->title);
        foreach ($tag->posts as $post) {
            dump($post->title);
        }*/

//        $posts = Rubric::find(1)->posts;
//        dump($posts);


        // Сессии

//        $request->session()->put('test', 'Test value');
        /*
        session(['cart' => [
            ['id' => 1, 'title' => 'Product 1'],
            ['id' => 2, 'title' => 'Product 2'],
        ]]);*/

        /*dump(session('test'));
        dump(session('cart')[1]['title']);
        dump($request->session()->get('cart')[0]['title']);*/

//        $request->session()->push('cart', ['id' => 3, 'title' => 'Product 3']);

//        dump($request->session()->all());

//        dump($request->session()->pull('test')); // pull нужен, для того чтобы прочитать значения и сразу же его удалить; в нашем случае после вывода на экран сессия удалиться

//        $request->session()->forget('test'); // удаляем выбранную сессию
//        $request->session()->flush(); // полностью удаляем содержимое сессии
//        dump(session()->all());


        // Работа с кэшем и куками

//        Cookie::queue('test', 'Test cookie', 5); // в queue мы передаем параметры чтобы создать куку: название, значение, время жизни куки(минуты)
//        Cookie::queue(Cookie::forget('test')); // удаления куку
//        dump(Cookie::get('test'));
        /*dump(Cookie::get('test'));
        dump($request->cookie('test'));*/

//        Cache::put('key', 'Value', 60);

//        dump(Cache::get('key'));

//        Cache::put('key', 'Value', 300); //через put мы записываем что-то в кеш; ключ, значение,время хранения кеша(секундах); Если мы хотим добавить кеш на неограниченное время не нужно указывать 3 параметр

        /*Cache::forget('key');
        dump(Cache::get('key'));*/

//        Cache::flush(); // полное очистка кэша

//        dump(Cache::pull('key')); // берем данные из кеша и сразу удаляем
//        dump(Cache::get('key'));




        $posts = Post::orderBy('created_at', 'desc')->paginate(3); // данные о каждой записи по ид
        $title = 'Home Page';
        return view('home', compact('title', 'posts'));
    }

    public function create()
    {
        $title = 'Create Post';
        $rubrics = Rubric::pluck('title', 'id')->all(); // получаем массив рубрик где ключами будет id а значениями будет title
        return view('create', compact('title', 'rubrics'));
    }

    public function store(Request $request) // данный метод будет сохранять данные из форм; Передаем объект запроса
    {
        /*dump($request->input('title'));
        dump($request->input('content'));
        dd($request->input('rubric_id'));*/
//        dd($request->all());

        /*$rules = [
            'title' => 'required|min:5|max:100',
            'content' => 'required',
            'rubric_id' => 'integer',
        ];
        $messages = [
            'title.required' => 'Заполните поле названия',
            'title.min' => 'Минимум 5 символов в названии',
            'rubric_id.integer' => 'Выберите рубрику из списка',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate(); */ // в make() передаем массив данных которых нужно валидировать, 2- правила валидации, 3 - массив ошибок валидации


        $this->validate($request, [ // указываем правила валидации для запроса($request)
            'title' => 'required|min:5|max:100',
            'content' => 'required',
            'rubric_id' => 'integer',
        ]);

        Post::create($request->all()); // создаем в БД в таблице posts по данным которые пришли из форм
        $request->session()->flash('success', 'Данные сохранены!'); // добавляем flash сообщения, тоесть когда мы попадаем на страницу в сессии у нас будут доступны данные значения, но только до следующей перезагрузке
        return redirect()->route('home'); // происходит редирект на страницу home
    }

}
