<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table = 'news';
    protected $fillable = ['title','body','thumbnail','updated_at','cropped','date','published_at','file'];
}
