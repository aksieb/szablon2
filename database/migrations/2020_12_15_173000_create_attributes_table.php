<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration {
    public function up() {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();

            $table->string('key')->unique();
            $table->string('name');
            $table->integer('unit');

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('attributes');
    }
}
