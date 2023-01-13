<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts() // здесь мы получаем связанные посты
    {
        return $this->belongsToMany(Post::class); // тут мы связываем с моделью Post
    }

}
