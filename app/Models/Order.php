<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $fillable = array(
        'finished_at', 'cancelled_at'
    );

    public function data() {
        return $this->hasOne(OrderData::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'order_product')
                    ->using(OrderProduct::class)
                    ->withPivot('id', 'quantity', 'created_at', 'updated_at');
    }
}
