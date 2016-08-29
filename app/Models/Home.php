<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;



class Home extends Model
{
    //
    protected $table = 'news';

    public function author()
    {
        return $this->belongsTo('Author');
    }

}
