<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_meta_datas';
    protected $fillable = ['user_id', 'occupation', 'website', 'bio', 'avatar', 'following', 'followers', 'likes', 'social_media', 'interests'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
