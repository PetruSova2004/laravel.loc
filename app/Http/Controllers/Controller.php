<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController // все контролеры которые мы создадим должны наследовать этот контролер!!!!!
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
