<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->enum('role', ['persona_juridica', 'persona_natural']);
            $table->string('password');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->rememberToken();

            //Recaudos

            // Cédula
            $table->string('dni_file_url')->nullable();
            $table->boolean('is_valid_dni')->nullable();
            $table->string('dni_errors')->nullable();

            // RIF
            $table->string('rif_file_url')->nullable();
            $table->boolean('is_valid_rif')->nullable();
            $table->string('rif_errors')->nullable();
            
            // Licencia de comerico de especies
            $table->string('comerce_species_license_file_url')->nullable();
            $table->boolean('is_valid_comerce_species_license')->nullable();
            $table->string('comerce_species_license_errors')->nullable();

            //  Autorización para la instalación y funcionamiento de Zoocriaderos
            $table->string('zoo_hatcheries_authorization_file_url')->nullable();
            $table->boolean('is_valid_zoo_hatcheries_authorization')->nullable();
            $table->string('zoo_hatcheries_authorization_errors')->nullable();

            // Registro Nacional de Colecciones Biologicas
            $table->string('national_register_of_biologic_colections_file_url')->nullable();
            $table->boolean('is_valid_national_register_of_biologic_colections')->nullable();
            $table->string('national_register_of_biologic_colections_errors')->nullable();

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
        Schema::dropIfExists('clients');
    }
}
