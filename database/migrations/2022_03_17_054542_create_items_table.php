<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('itemCode',50);
            $table->string('itemName',100);
            $table->string('brand',100);
            $table->boolean('production');
            $table->integer('packedQuantity');
            $table->integer('bulkQuantity');
            $table->integer('material1Quantity');
            $table->integer('material2Quantity');
            $table->integer('material3Quantity');
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
        Schema::dropIfExists('items');
    }
}
