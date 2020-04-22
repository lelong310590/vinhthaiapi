<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->string('product_code')->nullable()->comment('học viên');
            $table->string('class_name')->nullable()->comment('tên lớp');
            $table->double('price')->default(0);
            $table->double('discount')->default(0)->comment('Giá khuyến mại');
            $table->string('thumbnail')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('content')->nullable();
            $table->enum('status',['active','disable','new','hot'])->default('active');
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
        Schema::dropIfExists('product');
    }
}
