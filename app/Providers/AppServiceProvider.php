<?php

namespace App\Providers;

use App\Rubric;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(function ($query) { // тут мы получаем выполненные SQL запросы
//            dump($query->sql, $query->bindings);
//            Log::info($query->sql); // логируем(записываем по умолчанию в storage/logs sql запросы)
            Log::channel('sqllogs')->info($query->sql); // в channel указываем канал(config/logging.php) по которому будем сохранять логи
        });

        view()->composer('layouts.footer', function ($view) { // в composer указываем для какого вида нужно вызывать указанную функцию
            $view->with('rubrics', Rubric::all()); // берем всё из Rubric и передаем в переменную rubrics
        });
    }
}
