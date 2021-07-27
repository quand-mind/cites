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
            $table->string('valid_until'); //es una fecha
            $table->string('name', 45);
            $table->string('address', 250);
            $table->string('country', 60);
            $table->text('special_conditions', 500);
            $table->string('purpose', 60);
            $table->bigInteger('code_stamp');
            $table->string('name_scientific');
            $table->string('name_common');
            $table->string('decription', 250);
            $table->bigInteger('qty');
            $table->bigInteger('total');
            $table->string('unity');
            $table->string('country_origin');
            $table->string('permit_no');
            $table->string('date');
            $table->string('half_signature');
            $table->string('issued_by');
            $table->string('official_position');
            $table->string('palce');
            $table->string('date_permit');
            $table->string('permit_cancele');
            $table->string('observations');
            $table->string('port', null);
            $table->string('departure_date', null);
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
