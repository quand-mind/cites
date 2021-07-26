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
            $table->bigInteger('permit_no');
            $table->string('means', 45);
            $table->string('permit_type');
            $table->string('frequent_processing');
            $table->string('valid until'); //es una fecha
            $table->string('name_import', 45);
            $table->string('address_import', 250);
            $table->string('country_import', 60);
            $table->string('code_country_import', 60);
            $table->string('name_export', 45);
            $table->string('address_export', 250);
            $table->string('country_export', 60);
            $table->string('code_country_export', 60);
            $table->text('special_conditions', 500);
            $table->string('purpose', 60);
            $table->bigInteger('code_stamp');
            $table->bigInteger('code_stamp');
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
