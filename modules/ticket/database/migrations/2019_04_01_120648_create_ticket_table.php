<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent')->default(0);
            $table->string('domain')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->integer('owner')->default(0)->comment('Người gửi support');
            $table->string('support_name')->nullable()->comment('Bộ phận support');
            $table->string('thumbnail')->nullable()->comment('Ảnh đính kèm');
            $table->enum('status',['read','unread','resolve'])->default('unread');
            $table->enum('admin_status',['active','disable'])->default('disable');
            $table->string('type')->nullable()->comment('người dùng hoặc support reply');
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
        Schema::dropIfExists('ticket');
    }
}
