<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommercialNurseriesRequirements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercial_nurseries_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('solicitude_file_url');
            $table->boolean('is_valid_solicitude');
            $table->string('solicitude_errors')->nullable();

            $table->string('revenue_stamps_file_url');
            $table->boolean('is_valid_revenue_stamps');
            $table->string('revenue_stamps_errors')->nullable();

            $table->string('proyect_file_url');
            $table->boolean('is_valid_proyect');
            $table->string('proyect_errors')->nullable();

            $table->string('plane_file_url');
            $table->boolean('is_valid_plane');
            $table->string('plane_errors')->nullable();

            $table->string('property_file_url');
            $table->boolean('is_valid_property_file');
            $table->string('property_file_errors')->nullable();
            
            $table->foreignId('client_id')->references('id')->on('clients')->onDelete('cascade');
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
        Schema::dropIfExists('commercial_nurseries_requirements');
    }
}
