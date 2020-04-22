<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonomyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxonomy', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('taxonomy_type')->nullable();
            $table->text('excerpt')->nullable();
            $table->integer('index')->nullable();
            $table->enum('status',['active','disable','home','bottom'])->default('active');
            $table->integer('created_by')->default(0);
            $table->integer('edited_by')->default(0);
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
        Schema::dropIfExists('taxonomy');
    }
}
