<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsToForeignersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts_to_foreigners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('quantity')->nullable();
            $table->string('price')->nullable();
            $table->string('image_name')->nullable();
            $table->string('shop_id')->nullable();
            $table->string('model')->nullable();
            $table->string('brendi')->nullable();
            $table->string('markasi')->nullable();
            $table->string('Org_Dub')->nullable();
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
        Schema::dropIfExists('carts_to_foreigners');
    }
}
