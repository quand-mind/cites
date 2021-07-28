<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->bigInteger('dni')->unique();
            //$table->enum('role', ['admin', 'writer', 'superuser', 'perosna_juridica', 'persona_natural']);
            //$table->string('email')->unique();
            //$table->string('password');
            $table->boolean('is_active')->default(true);
           // $table->string('username');
            $table->string('photo')->default('/images/default-user.png');
            //$table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
