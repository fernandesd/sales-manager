<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->float('price');
            $table->unsignedInteger('delivery_time');
            $table->unsignedInteger('quantity');

            $table->unsignedBigInteger('sale_id')->unsigned();
            $table->foreign('sale_id')
                ->references('id')->on('sales')
                ->onDelete('cascade');

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
        Schema::dropIfExists('sale_items');
    }
}
