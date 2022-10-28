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
            $table->enum('role', ['natural', 'juridica']);
            $table->string('password');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->rememberToken();
            // Cédula
            $table->string('dni_file_url')->nullable();
            $table->boolean('is_valid_dni')->nullable();

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
