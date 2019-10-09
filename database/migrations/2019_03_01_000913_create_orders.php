<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sh_orders', function (Blueprint $table) {

            $table->increments('id');

            $table->string('name');
            $table->string('phone', 50)->default('');
            $table->string('comment', 512)->default('');
            $table->string('order', 512)->default('');
            $table->tinyInteger('sort')->default(0);
            $table->tinyInteger('status')->default(0);

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
        Schema::dropIfExists('sh_orders');
    }
}
