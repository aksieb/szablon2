<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration {
    public function up() {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('filename_original');
            $table->string('mime')->nullable()->default(null);
            $table->string('extension')->nullable()->default(null);
            $table->string('size')->nullable()->default(null);
            $table->string('md5')->nullable()->default(null);

            $table->string('relation')->nullable()->default(null);
            $table->unsignedBigInteger('foreign_id')->nullable()->default(null);

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('files');
    }
}
