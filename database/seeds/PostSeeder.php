<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class, 100)->create(); // берем указанную фабрику и указываем сколько записей данной фабрики нужно создать
    }
}
