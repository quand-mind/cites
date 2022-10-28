<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsInGlosary2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('glosary', function (Blueprint $table) {
            $table->string('word', 100)->change();
            $table->text('description')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('glosary', function (Blueprint $table) {
            $table->string('word', 100)->change();
            $table->string('description', 300)->change();
        });
    }
}
