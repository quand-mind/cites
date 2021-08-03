<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportNoComercialSpeciesRequirements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_no_comercial_species_requirements', function (Blueprint $table) {
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
            
            $table->string('species_register_file_url');
            $table->boolean('is_valid_species_register');
            $table->string('species_register_errors')->nullable();
            
            $table->string('park_authorization_file_url');
            $table->boolean('is_valid_park_authorization');
            $table->string('park_authorization_errors')->nullable();

            $table->boolean('is_valid_species_legal_documents');
            $table->string('species_legal_documents_errors')->nullable();

            $table->string('sanitary_permit_file_url');
            $table->boolean('is_valid_sanitary_permit');
            $table->string('sanitary_permit_errors')->nullable();

            $table->string('national_register_of_biologic_colections_file_url');
            $table->boolean('is_valid_national_register_of_biologic_colections');
            $table->string('national_register_of_biologic_colections_errors')->nullable();
            
            $table->string('introduced_species_authorization_file_url');
            $table->boolean('is_valid_introduced_species_authorization');
            $table->string('introduced_species_authorization_errors')->nullable();
            
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
        Schema::dropIfExists('import_no_comercial_species_requirements');
    }
}
