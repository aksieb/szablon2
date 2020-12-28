<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDataTable extends Migration {
    public function up() {
        Schema::create('order_data', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('country');
            $table->string('city');
            $table->string('zipcode');
            $table->string('street')->nullable();
            $table->string('house_number');
            $table->string('apartment_number')->nullable();
            $table->string('email');
            $table->string('phone');

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('order_data');
    }
}
