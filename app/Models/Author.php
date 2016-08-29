<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Home;

class Author extends Model
{
    //
    protected $table = 'author';

    public function news()
    {
        return $this->hasOne('Home');
    }
}
