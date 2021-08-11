<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequerimentPermitTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requeriment_permit_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permit_type_id')->references('id')->on('permit_types')->onDelete('cascade')->constrained()->onDelete('cascade');
            $table->foreignId('requeriment_id')->references('id')->on('requeriments')->onDelete('cascade')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('requeriment_permit_type');
    }
}
