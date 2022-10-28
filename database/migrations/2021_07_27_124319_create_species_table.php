<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            // $table->string('ap');
            $table->string('name_scientific', 45);
            $table->string('name_common', 45);
            $table->bigInteger('search_id');
            $table->string('appendix');
            //$table->bigInteger('qty'); //-> cantidad
            $table->string('type');
            //$table->string('permit_no');
            //$table->bigInteger('code_stamp');    
            //$table->string('date');
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
        Schema::dropIfExists('species');
    }
}
