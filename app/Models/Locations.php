<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    //
    protected $table = 'locations';
    protected $guarded = 'id';
    public function gallerys()
    {
        return $this->hasMany('App\Models\gallery', 'id');
    }
}
