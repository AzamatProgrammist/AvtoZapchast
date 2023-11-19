<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsToBarcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barcodes', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('Org_Dub')->nullable();
            $table->string('model')->nullable();
            $table->string('brendi')->nullable();
            $table->string('markasi')->nullable();
            $table->string('chiqqan_yili')->nullable();
            $table->string('kelgan_yili')->nullable();
            $table->string('size')->nullable();
            $table->string('full_price')->nullable();
            $table->string('sotish_narxi')->nullable();
            $table->string('weight')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barcodes', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('Org_Dub');
            $table->dropColumn('model');
            $table->dropColumn('brendi');
            $table->dropColumn('markasi');
            $table->dropColumn('chiqqan_yili');
            $table->dropColumn('kelgan_yili');
            $table->dropColumn('size');
            $table->dropColumn('full_price');
            $table->dropColumn('sotish_narxi');
            $table->dropColumn('weight');
        });
    }
}
