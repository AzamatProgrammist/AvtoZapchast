<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBarcodeToInkassaSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inkassa_subs', function (Blueprint $table) {
            $table->string('barcode')->nullable()->after('markasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inkassa_subs', function (Blueprint $table) {
            $table->dropColumn('barcode');
        });
    }
}
