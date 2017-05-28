<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'description', 'image_ori', 'image_card', 'date', 'venue', 'status', 'ext_id'
    ];

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function ticketsCount() {
        $count = 0;
        foreach ($this->tickets as $ticket) {
            $count += $ticket->available;
        }
        return $count;
    }

    public function purchases() {
        return $this->hasMany(Purchase::class);
    }

    public function countRows() {
        $result = 0;
        foreach ($this->purchases as $purchase) {
            foreach ($purchase->items as $item) {
                $result = $result + $item->passes()->count();
            }
        }
        return $result;
    }

    public function tags() {
        return $this->hasMany(Tag::class);
    }
}
