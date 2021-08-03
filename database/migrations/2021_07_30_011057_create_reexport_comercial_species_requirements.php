<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReexportComercialSpeciesRequirements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reexport_comercial_species_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('import_form_file_url');
            $table->boolean('is_valid_import_form');
            $table->string('import_form_errors')->nullable();

            $table->string('revenue_stamps_file_url');
            $table->boolean('is_valid_revenue_stamps');
            $table->string('revenue_stamps_errors')->nullable();

            $table->string('dni_file_url');
            $table->boolean('is_valid_dni');
            $table->string('dni_errors')->nullable();

            $table->string('rif_file_url');
            $table->boolean('is_valid_rif');
            $table->string('rif_errors')->nullable();
            
            $table->string('zoo_hatcheries_authorization_file_url');
            $table->boolean('is_valid_zoo_hatcheries_authorization');
            $table->string('zoo_hatcheries_authorization_errors')->nullable();

            $table->string('comerce_species_license_file_url');
            $table->boolean('is_valid_comerce_species_license');
            $table->string('comerce_species_license_errors')->nullable();

            $table->boolean('is_valid_species_legal_documents');
            $table->string('species_legal_documents_errors')->nullable();
            
            $table->foreignId('client_id')->references('id')->on('clients')->onDelete('cascade');

            $table->foreignId('permit_id')->references('id')->on('permits')->onDelete('cascade');
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
        Schema::dropIfExists('reexport_comercial_species_requirements');
    }
}
