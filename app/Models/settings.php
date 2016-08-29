<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    //
    protected $table = 'settings';
    protected $fillable = ['city','phone','email','price'];
}
