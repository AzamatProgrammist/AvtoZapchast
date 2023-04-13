<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductIdToCartsToForeignersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts_to_foreigners', function (Blueprint $table) {
            
            $table->string('product_id')->nullable()->after('Org_Dub');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts_to_foreigners', function (Blueprint $table) {
            
            $table->dropColumn('product_id');
            
        });
    }
}
