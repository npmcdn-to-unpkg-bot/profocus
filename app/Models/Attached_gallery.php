<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attached_gallery extends Model
{
    //
    protected $table = 'attached_gallery';
    protected $fillable = ['type','type_id','gallery_id'];
}
