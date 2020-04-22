<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('roles', function (Blueprint $table) {
		    $table->engine = 'InnoDB';
		    $table->increments('id');
		    $table->string('name')->unique();
		    $table->string('display_name')->nullable();
		    $table->string('description')->nullable();
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
	    Schema::dropIfExists('roles');
	    Schema::dropIfExists('role_user');
	    Schema::dropIfExists('permissions');
	    Schema::dropIfExists('permission_role');
    }
}
