<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formalities', function (Blueprint $table) {
            $table->id();
            $table->string('sistra')->nullable();
            $table->bigInteger('request_formalitie_no');
            $table->string('status');
            $table->text('special_conditions', 500)->nullable();
            $table->string('observations')->nullable();
            $table->string('collected_time')->nullable(); //campo que llevara el tiempo  para cargar todos los recaudos
            $table->foreignId('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreignId('official_id')->nullable()->references('id')->on('officials')->onDelete('cascade');
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
        Schema::dropIfExists('formalities');
    }
}
