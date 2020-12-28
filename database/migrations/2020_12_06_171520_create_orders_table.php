<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->timestamps();
            $table->timestamp('finished_at')->nullable()->default(null);
        });
    }

    public function down() {
        Schema::dropIfExists('orders');
    }
}
