<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('faq_id');
            $table->unsignedInteger('faq_category_id');
            $table->timestamps();

            $table->foreign('faq_id')->references('id')->on('faqs');
            $table->foreign('faq_category_id')->references('id')->on('faq_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqs_categories');
    }
}
