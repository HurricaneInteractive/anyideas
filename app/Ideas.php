<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ideas extends Model
{
    //
    protected $fillable = ['user_id', 'title', 'pitch', 'status', 'tags', 'description', 'darts', 'image'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function timeline() {
        return $this->hasMany(Timeline::class);
    }
    
}
