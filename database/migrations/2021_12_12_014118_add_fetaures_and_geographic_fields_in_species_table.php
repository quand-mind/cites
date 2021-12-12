<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFetauresAndGeographicFieldsInSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('species', function (Blueprint $table) {
            $table->text('features')->nullable();
            $table->text('geographic_distribution')->nullable();
            $table->dropColumn('img');
            $table->string('male_img');
            $table->string('female_img');
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
            $table->dropColumn('features');
            $table->dropColumn('geographic_distribution');
            $table->string('img');
            $table->dropColumn('male_img');
            $table->dropColumn('female_img');
        });
    }
}
