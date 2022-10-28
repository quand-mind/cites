<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequerimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requeriments', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('short_name', 50)->nullable();
            $table->enum('type', ['physical', 'web', 'personal', 'form']);
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
        Schema::dropIfExists('requeriments');
    }
}
