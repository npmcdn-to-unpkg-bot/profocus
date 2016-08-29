<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    //
    protected $table = "models";
    protected $fillable = [ 'name', 'about', 'bust', 'waist', 'hips', 'dress', 'shoe', 'hair', 'eyes', 'thumbnail_wide', 'thumbnail', 'stature' ];
    public function gallery()
    {
        return $this->belongsToMany('App\Models\gallery');
    }
}











