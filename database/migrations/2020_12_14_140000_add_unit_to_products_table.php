<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitToProductsTable extends Migration {

    public function up() {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('unit');
        });
    }

    public function down() {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('unit');
        });
    }
}
