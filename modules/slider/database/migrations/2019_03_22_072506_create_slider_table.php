<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->integer('group_id')->default(0);
            $table->string('thumbnail')->nullable();
            $table->text('content')->nullable();
            $table->string('url')->nullable();
            $table->string('button_name')->nullable();
            $table->integer('index')->default(0);
            $table->integer('created_by')->default(0);
            $table->integer('edited_by')->default(0);
            $table->enum('status',['active','disable'])->default('active');
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
        Schema::dropIfExists('slider');
    }
}
