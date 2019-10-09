<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sh_products', function (Blueprint $table) {

            $table->increments('id');

            $table->string('name');
            $table->string('alias')->unique();
            $table->string('description', 512)->default('');
            $table->integer('category')->default(0);
            $table->string('unit')->default('');
            $table->integer('price')->default(0);
            $table->string('image')->default('');
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
        Schema::dropIfExists('sh_products');
    }
}
