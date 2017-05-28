<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'user_id', 'event_id', 'purchase_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function countRows() {
        $result = 0;
        foreach ($this->items as $item) {
            $result = $result + $item->passes()->count();
        }

        return $result;
    }

    public function refundable() {
        if ($this->purchase_id == 'FREE-ID')
            return false;

        foreach ($this->items as $item) {
            foreach ($item->passes as $pass) {
                if ($pass->used_on != null)
                    return false;
            }
        }
        return true;
    }

    public function refunding() {
        if ($this->refund_at != null && $this->refunded_at == null)
            return true;
        return false;
    }

    public function refunded() {
        if ($this->refunded_at != null)
            return true;
        return false;
    }

}
