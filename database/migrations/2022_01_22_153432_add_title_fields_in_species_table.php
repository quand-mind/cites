<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleFieldsInSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('species', function (Blueprint $table) {
            $table->string('male_title', 300)->nullable();
            $table->string('female_title', 300)->nullable();
            $table->string('male_img')->nullable()->change();
            $table->string('female_img')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('species', function (Blueprint $table) {
            $table->dropColumn('male_img');
            $table->dropColumn('female_img');
        });
    }
}
