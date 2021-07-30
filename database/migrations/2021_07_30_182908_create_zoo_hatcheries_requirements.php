<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZooHatcheriesRequirements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoo_hatcheries_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('solicitude_file_url');
            $table->bolean('is_valid_solicitude');
            $table->string('solicitude_errors')->nullable();
            
            $table->string('revenue_stamps_file_url');
            $table->bolean('is_valid_revenue_stamps');
            $table->string('revenue_stamps_errors')->nullable();
            
            $table->string('proyect_file_url');
            $table->bolean('is_valid_proyect');
            $table->string('proyect_errors')->nullable();
            
            $table->string('property_file_url');
            $table->bolean('is_valid_property_file');
            $table->string('property_file_errors')->nullable();
            
            $table->string('territory_occupation_authorization_file_url');
            $table->bolean('is_valid_territory_occupation_authorization_file');
            $table->string('territory_occupation_authorization_file_errors')->nullable();
            
            $table->string('foliate_control_book_file_url');
            $table->bolean('is_valid_foliate_control_book_file');
            $table->string('foliate_control_book_file_errors')->nullable();

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
        Schema::dropIfExists('zoo_hatcheries_requirements');
    }
}
