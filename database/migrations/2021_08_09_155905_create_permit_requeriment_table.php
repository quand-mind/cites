<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitRequerimentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permit_requeriment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permit_id')->references('id')->on('permits')->onDelete('cascade')->constrained()->onDelete('cascade');
            $table->foreignId('requeriment_id')->references('id')->on('requeriments')->onDelete('cascade')->constrained()->onDelete('cascade');
            $table->string('file_url')->nullable();
            $table->boolean('is_valid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permit_requeriment');
    }
}
