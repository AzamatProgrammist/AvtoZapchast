<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWarehouseIdToInkassasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inkassas', function (Blueprint $table) {
            $table->string('warehouse_id')->nullable()->after('numeric');
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
            $table->dropColumn('warehouse_id');
        });
    }
}
