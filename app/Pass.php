<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pass extends Model
{
    public $table = "pass";

    protected $fillable = [
        'number', 'item_id', 'price'
    ];

    public function item() {
        return $this->belongsTo(Item::class);
    }
}
