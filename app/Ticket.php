<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'name', 'description', 'event_id', 'price', 'total', 'available', 'status', 'ext_id'
    ];

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function items() {
        return $this->hasMany(Item::class);
    }
}
