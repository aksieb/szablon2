<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $fillable = [
        'name',
        'description',
        'quantity', 'unit',
        'category_id'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function productAttributes() {
        return $this->hasMany(ProductAttribute::class);
    }

    public function attributes() {
        return $this->belongsToMany(Attribute::class, 'product_attribute')
                    ->using(ProductAttribute::class)
                    ->withPivot('value');
    }

    public function price() {
        foreach($this->productAttributes as $pa) {
            if($pa->attribute->key == 'price') {
                return $pa->value;
            }
        }

        return 1;
    }

    public function existsInCart() {
        $id = $this->id;

        $cart = session('cart', array());
        $quantity = array_key_exists($id, $cart) ? $cart[$id] : null;

        return $quantity;
    }

    public function files() {
        return $this->hasMany(File::class, 'foreign_id', 'id')->where('relation', 'products');
    }
}
