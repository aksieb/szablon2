<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model {

    protected $fillable = [
        'key',
        'name',
        'unit',
    ];

    public function productAttributes() {
        return $this->hasMany(ProductAttribute::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'product_attribute')
                    ->using(ProductAttribute::class)
                    ->withPivot('value');
    }
}
