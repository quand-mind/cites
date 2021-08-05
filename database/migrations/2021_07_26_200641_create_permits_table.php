<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permits', function (Blueprint $table) {
            $table->id();
            $table->integer('request_permit_no')->nullable();
            $table->string('means', 45)->nullable();
            $table->string('permit_type')->nullable();
            $table->string('frequent_processing')->nullable();
            $table->string('valid_until')->nullable(); //es una fecha valido hasta
            $table->string('name', 45)->nullable(); //nompre del solicitante
            $table->string('address', 250)->nullable(); //direccion
            $table->string('country', 60)->nullable(); //país
            $table->text('special_conditions', 500)->nullable(); //conndiciones especiales
            $table->string('purpose', 60)->nullable(); //proposito
            $table->string('half_signature')->nullable();
            $table->string('issued_by')->nullable(); //nombre del funcionario 
            $table->string('official_position')->nullable(); //cargo del funcionario
            $table->string('palce')->nullable(); //lugar
            $table->string('date_permit')->nullable();
            $table->string('permit_cancele')->nullable();
            $table->string('observations')->nullable();
            $table->string('port')->nullable();
            $table->string('departure_date')->nullable();
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
        Schema::dropIfExists('permits');
    }
}
