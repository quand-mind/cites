<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeSpeciesRequirements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_species_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('species_exchange_authorization_file_url');
            $table->bolean('is_valid_species_exchange_authorization');
            $table->string('species_exchange_authorization_errors')->nullable();
            
            $table->string('species_transfer_authorization_file_url');
            $table->bolean('is_valid_species_transfer_authorization');
            $table->string('species_transfer_authorization_errors')->nullable();

            $table->string('exchange_agreement_file_url');
            $table->bolean('is_valid_exchange_agreement');
            $table->string('exchange_agreement_errors')->nullable();
            
            $table->foreignId('exports_id')->references('id')->on('exports_no_comercial_species_requirements')->onDelete('cascade');
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
        Schema::dropIfExists('exchange_species_requirements');
    }
}
