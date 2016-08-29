<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';
//    public $fillable = [ 'type','title','body','webm','mp4','cover','path' ];
    public $guarded = ['id'];

}
