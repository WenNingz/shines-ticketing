<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'post_id', 'message', 'user_id', 'parent_id'
    ];

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function children() {
        return $this->hasMany(Reply::class, 'parent_id');
    }

    public function childrenCount() {
        return $this->children()->count();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getUserName() {
        $user = $this->user()->first();
        return $user->first_name . ' ' . $user->last_name;
    }

    public function getUserInitial() {
        $user = $this->user()->first();
        return substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1);
    }

}
