<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Post
 * @package App
 * @mixin Builder
 */
class Post extends Model // тут мы создали модель с миграции для неё
{
    // При создании модели через консоль всё создаётся автоматически, но иногда мы получаем по другому таблицы из базы данных, и нам нужно привязать модель к той таблице которая к нам пришла, тут мы изменяем настройки которые по умолчанью использует laravel

//    protected $table = 'my_posts'; // тут мы подсказываем как будет называться наша таблица если мы решили её переименовать, laravel будет искать таблицу с таким именем и привязывать её с данной моделью
//    protected $primaryKey = 'post_id'; // подсказываем как будет называться поле первичного ключа
//    public $incrementing = false; // убираем авто-инкремент
//    protected $keyType = 'string'; // указываем какой тип данных будет использовать primaryKey
//    public $timestamps = false;
//    protected $attributes = [
//        // это свойство нам нужно чтобы laravel что-то заполнял автоматически в нашу БД
//        'content' => 'Lorem',
//    ];

    protected $fillable = ['title', 'content', 'rubric_id']; // указываем поля, которые разрешаем массово заполнять(Post::create([и тут находятся эти параметры]))

    public function rubric()
    {
        return $this->belongsTo(Rubric::class);
    }

    public function tags() // получаем теги
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getPostDate() // возвращаем нужный формат даты
    {
        /* $formatter = new \IntlDateFormatter('ru_RU', \IntlDateFormatter::FULL, \IntlDateFormatter::FULL);
         $formatter->setPattern('d MMM y');
         return $formatter->format(new \DateTime($this->created_at));*/ // переводим время на руский
        return Carbon::parse($this->created_at)->diffForHumans(); // получаем разницу между текущим временем и временем когда была создана запись
    }

    public function setTitleAttribute($value) // после get нужно указать поле которое нужно изменить из БД; в $value приходит значение из поля которое указано после set; в нашем случае то что попало в title
    {
        $this->attributes['title'] = Str::title($value); // приводим каждое слово в верхнем регистре
    }


    public function getTitleAttribute($value) // после get нужно указать поле которое нужно получить из БД
    {
        return Str::upper($value); // возвращаем значение полностью в верхнем регистре
    }


}
