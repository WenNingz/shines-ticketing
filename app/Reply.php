<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'post_id', 'message', 'user_id'
    ];

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
