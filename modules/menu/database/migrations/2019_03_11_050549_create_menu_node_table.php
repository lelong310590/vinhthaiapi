<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuNodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_node', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id');
            $table->integer('parent');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('menu_type')->nullable();
            $table->integer('type_id')->nullable()->default(0);
            $table->string('url')->nullable();
            $table->integer('index')->default(0);
            $table->string('target')->nullable();
            $table->boolean('is_home')->nullable()->default(false);
            $table->enum('status',['active','disable'])->default('active');
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
        Schema::dropIfExists('menu_node');
    }
}
