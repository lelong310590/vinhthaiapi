<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs_item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question')->nullable();
            $table->string('answer')->nullable();
            $table->integer('group')->nullable();
            $table->enum('status', ['active', 'disable'])->default('active');
            $table->integer('sort')->default(0);
            $table->integer('created_by')->nullable();
            $table->integer('edited_by')->nullable();
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
        Schema::dropIfExists('faqs_items');
    }
}
