<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_price', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('price')->nullable();
            $table->string('sale_price')->nullable();
            $table->string('price_type')->nullable()->comment('Kiểu giá theo sản phẩm, năm, tháng');
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->enum('status', ['active', 'disable'])->default('active');
            $table->boolean('main')->default(false);
            $table->integer('created_by')->nullable();
            $table->integer('edited_by')->nullable();
            $table->integer('group')->nullable();
            $table->integer('index')->default(0);
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
        Schema::dropIfExists('table_price');
    }
}
