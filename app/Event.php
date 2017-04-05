<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'date', 'venue', 'status'
    ];

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }
}
