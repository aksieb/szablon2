<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderData extends Model {

    protected $table = 'order_data';

    protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'country',
        'city',
        'street',
        'zipcode',
        'house_number',
        'apartment_number',
        'email',
        'phone'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
