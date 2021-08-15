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
            $table->string('valid_until')->nullable(); //es una fecha valido hasta
            $table->text('special_conditions', 500)->nullable();
            $table->string('purpose', 60);
            $table->string('status');
            $table->string('observations')->nullable();
            $table->string('transportation_way')->nullable();
            $table->string('consignado_a')->nullable();
            $table->string('country')->nullable();
            $table->string('port_boarding')->nullable();
            $table->string('port_disembarkation')->nullable();
            $table->string('destiny_place')->nullable();
            $table->string('place_departure')->nullable();
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
