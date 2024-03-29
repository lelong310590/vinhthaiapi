<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuthorFieldToGroupContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_group', function (Blueprint $table) {
            $table->integer('created_by')->nullable();
            $table->integer('edited_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_group', function (Blueprint $table) {
            $table->dropColumn('created_by');
            $table->dropColumn('edited_by');
        });
    }
}
