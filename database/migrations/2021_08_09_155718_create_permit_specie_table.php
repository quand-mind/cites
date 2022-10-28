<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitSpecieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permit_specie', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permit_id')->references('id')->on('permits')->onDelete('cascade')->constrained()->onDelete('cascade');
            $table->foreignId('specie_id')->references('id')->on('species')->onDelete('cascade')->constrained()->onDelete('cascade');
            $table->string('description', 250)->nullable();
            $table->string('origin');
            $table->string('origin_country');
            $table->string('file_url')->nullable();
            $table->bigInteger('qty');
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
        Schema::dropIfExists('permit_specie');
    }
}
