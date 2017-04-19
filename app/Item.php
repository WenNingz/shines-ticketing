<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'ticket_id', 'purchase_id'
    ];

    public function ticket() {
        return $this->belongsTo(Ticket::class);
    }

    public function purchases() {
        return $this->belongsTo(Purchase::class);
    }

    public function passes() {
        return $this->hasMany(Pass::class);
    }

    public function passCount() {
        return $this->passes()->count();
    }

    public function amount() {
        $amount = $this->ticket->price * $this->passCount();
        return number_format((float)$amount, 2, '.', '');
    }
}
