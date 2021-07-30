<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportComercialsColombiaSpeciesRequirements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_comercials_colombia_species_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('export_permit_file_url');
            $table->bolean('is_valid_export_permit');
            $table->string('export_permit_errors')->nullable();

            $table->string('comercial_agreements_file_url');
            $table->bolean('is_valid_comercial_agreements');
            $table->string('comercial_agreements_errors')->nullable();

            $table->string('ambiental_license_file_url');
            $table->bolean('is_valid_ambiental_license');
            $table->string('ambiental_license_errors')->nullable();
            
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
        Schema::dropIfExists('import_comercials_colombia_species_requirements');
    }
}
