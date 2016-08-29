<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class gallery extends Model
{
    //
    protected $table = 'gallery';
    protected $guarded = ['id'];
    public function location()
    {
        return $this->belongsTo('App\Models\Locations');
    }

}
