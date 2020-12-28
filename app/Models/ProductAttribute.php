<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductAttribute extends Pivot {

    protected $fillable = [
        'product_id',
        'attribute_id',
        'value',
    ];

    public function attribute() {
        return $this->belongsTo(Attribute::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
