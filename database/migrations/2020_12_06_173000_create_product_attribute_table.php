<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributeTable extends Migration {
    public function up() {
        Schema::create('product_attribute', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            $table->string('key');
            $table->string('value');

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('product_attribute');
    }
}
