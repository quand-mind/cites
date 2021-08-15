<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->boolean('is_subpage')->default(false);
            $table->boolean('is_onMenu')->default(false);
            $table->string('meta_description')->nullable();
            $table->string('meta_robots')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('content');
            $table->unsignedInteger('menu_order')->nullable();
            //$table->unsignedInteger('created_by');
            //$table->unsignedInteger('lastModified_by');
            $table->unsignedInteger('main_page')->nullable();
            $table->timestamps();

            $table->foreignId('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('lastModified_by')->references('id')->on('users')->onDelete('cascade');

            // $table->foreignId('main_page')->references('id')->on('pages')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
