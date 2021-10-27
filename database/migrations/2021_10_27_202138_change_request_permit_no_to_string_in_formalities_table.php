<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRequestPermitNoToStringInFormalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formalities', function (Blueprint $table) {
            $table->string('request_formalitie_no', 15)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formalities', function (Blueprint $table) {
            $table->bigInteger('request_formalitie_no')->change();
        });
    }
}
