<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) { // Faker генерирует фейковые данные
    return [
        'title' => $faker->words(3, true), // 3 слова в виде строки
        'content' => $faker->paragraph(1), // 1 параграф
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
        'rubric_id' => $faker->numberBetween(1, 5),
    ];
});
