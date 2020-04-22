<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');
            $table->string('post_title')->nullable();
            $table->string('post_slug')->nullable();
            $table->text('post_excerpt')->nullable();
            $table->text('post_content')->nullable();
            $table->string('post_author')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('post_type')->nullable();
            $table->string('post_template')->nullable();
            $table->enum('post_status',['publish','draft','inherit'])->default('draft');
            $table->integer('edited_by')->nullable();
            $table->timestamp('publish_at')->nullable();
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
        Schema::dropIfExists('post');
    }
}
