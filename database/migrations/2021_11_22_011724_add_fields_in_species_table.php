<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('species', function (Blueprint $table) {
            $table->text('general_appearance')->nullable();
            $table->string('img')->nullable();
            $table->string('measurements')->nullable();
            $table->float('aprox_weight')->nullable();
            $table->string('pelage')->nullable();
            $table->text('head_profile')->nullable();
            $table->string('neck_mane')->nullable();
            $table->string('sexual_dimorphism')->nullable();
            $table->text('juvenile')->nullable();
            $table->text('distribution')->nullable();
            $table->string('wild_population')->nullable();
            $table->string('captive_population')->nullable();
            $table->string('intraspecific_variation')->nullable();
            $table->text('blibliography')->nullable();
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
            $table->dropColumn('general_appearance');
            $table->dropColumn('img');
            $table->dropColumn('measurements');
            $table->dropColumn('aprox_weight');
            $table->dropColumn('pelage');
            $table->dropColumn('head_profile');
            $table->dropColumn('neck_mane');
            $table->dropColumn('sexual_dimorphism');
            $table->dropColumn('juvenile');
            $table->dropColumn('distribution');
            $table->dropColumn('wild_population');
            $table->dropColumn('captive_population');
            $table->dropColumn('intraspecific_variation');
            $table->dropColumn('blibliography');
        });
    }
}
