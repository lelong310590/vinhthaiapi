<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('post_id')->default(0);
            $table->string('name')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('comment_content')->nullable();
            $table->string('website')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('parent')->default(0);
            $table->string('comment_type')->nullable();
            $table->enum('approved',['accept','cancel'])->default('cancel')->comment('Duyệt comment');
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
        Schema::dropIfExists('comment');
    }
}
