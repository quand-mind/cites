<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportsComercialSpeciesRequirements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exports_comercial_species_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('export_form_file_url');
            $table->bolean('is_valid_export_form');
            $table->string('export_form_errors')->nullable();

            $table->string('revenue_stamps_file_url');
            $table->bolean('is_valid_revenue_stamps');
            $table->string('revenue_stamps_errors')->nullable();

            $table->string('species_legal_documents_file_url');
            $table->bolean('is_valid_species_legal_documents');
            $table->string('species_legal_documents_errors')->nullable();
            
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
        Schema::dropIfExists('exports_comercial_species_requirements');
    }
}
