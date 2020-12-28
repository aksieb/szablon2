<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConvertProductAttributesTable extends Migration {

    public function up() {
        Schema::table('product_attribute', function (Blueprint $table) {
            $table->dropColumn('key');
            $table->unsignedBigInteger('attribute_id');
            $table->foreign('attribute_id')->references('id')->on('attributes');
        });
    }

    public function down() {
        Schema::table('product_attribute', function (Blueprint $table) {
            $table->string('key');
            $table->dropForeign('attribute_id');
            $table->dropColumn('attribute_id');
        });
    }
}
