<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @package App
 * @mixin Builder
 */
class Rubric extends Model
{
    // $rubric = Rubric::find(1);
    // $rubric->post
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
