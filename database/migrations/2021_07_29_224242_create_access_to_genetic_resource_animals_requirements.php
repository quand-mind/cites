<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessToGeneticResourceAnimalsRequirements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_to_genetic_resource_animals_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('subscription_document_file_url');
            $table->bolean('is_valid_subscription_document');
            $table->string('subscription_document_errors')->nullable();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access_to_genetic_resource_animals_requirements');
    }
}
