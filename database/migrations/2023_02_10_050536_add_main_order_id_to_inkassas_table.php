<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMainOrderIdToInkassasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inkassas', function (Blueprint $table) {
            $table->string('mainOrder_id')->nullable()->after('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inkassas', function (Blueprint $table) {
            $table->dropColumn('mainOrder_id');
        });
    }
}
