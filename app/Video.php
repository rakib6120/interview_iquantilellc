<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['source', 'desc', 'total_reviews', 'total_points', 'rate_in_percent', 'rate'];

    public function video_uploader(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
