<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'event_id'];

    public function tag() {
        return $this->belongsTo(Event::class);
    }

}
