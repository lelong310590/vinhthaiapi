<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonial', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('office')->nullable()->comment('Chức vụ');
            $table->string('company')->nullable()->comment('Công ty');
            $table->text('content')->nullable();
            $table->enum('status', ['active', 'disable'])->default('active');
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
        Schema::dropIfExists('testimonial');
    }
}
