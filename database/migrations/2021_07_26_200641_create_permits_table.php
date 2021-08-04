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
            $table->bigInteger('request_permit_no');
            $table->string('means', 45);
            $table->string('permit_type');
            $table->string('frequent_processing');
            $table->string('valid_until'); //es una fecha valido hasta
            $table->string('name', 45); //nompre del solicitante
            $table->string('address', 250); //direccion
            $table->string('country', 60); //país
            $table->text('special_conditions', 500); //conndiciones especiales
            $table->string('purpose', 60); //proposito
            $table->string('half_signature')->nullable();
            $table->string('issued_by')->nullable(); //nombre del funcionario 
            $table->string('official_position')->nullable(); //cargo del funcionario
            $table->string('palce'); //lugar
            $table->string('date_permit');
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
