<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
        'category_id'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function categories() {
        return $this->hasMany(Category::class);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
