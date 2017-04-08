<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'ticket_number', 'title', 'message', 'category', 'status', 'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }

    public function getReplies(){
        return $this->replies()->where('parent_id', null)->get();
    }

    public function getParentId($user_id) {
        return $this->replies()->where('user_id', $user_id)
            ->where('parent_id', null)->orderBy('created_at', 'desc')->first();
    }
}
