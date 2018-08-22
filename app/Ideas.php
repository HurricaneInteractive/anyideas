<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ideas extends Model
{
    //
    protected $fillable = ['title', 'pitch', 'status', 'description, image, tags'];
}
