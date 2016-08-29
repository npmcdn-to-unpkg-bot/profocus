<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    //
    protected $table = 'Pages';
    protected $fillable = [ 'title','body','thumbnail' ];
}
