<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInkassasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inkassas', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name')->nullable();
            $table->string('admin')->nullable();
            $table->string('products_num')->nullable();
            $table->string('full_price')->nullable();
            $table->string('status')->nullable();
            $table->string('date')->nullable();
            $table->string('shop_id')->nullable();
            $table->string('numeric')->nullable();
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
        Schema::dropIfExists('inkassas');
    }
}
