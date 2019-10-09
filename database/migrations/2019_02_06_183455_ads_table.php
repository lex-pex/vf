<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('ads', function (Blueprint $table) {

            $table->increments('id');

            $table->string('label', 100)->default('');
            $table->integer('inner_id')->default(0);
            $table->string('url')->default('');
            $table->string('image')->default('');
            $table->string('title')->default('');
            $table->string('text')->default('');
            $table->integer('order')->default(0);
            $table->tinyInteger('status')->default(0);

            $table->timestamps();

        });

    }

    /*

    $table->string('label', 100)->nullable()->default('');
    $table->integer('inner_id')->nullable()->default(0);
    $table->string('url')->nullable()->default('');
    $table->string('image')->nullable()->default('');
    $table->string('title')->nullable()->default('');
    $table->string('text')->nullable()->default('');
    $table->integer('order')->nullable()->default(0);
    $table->tinyInteger('status')->nullable()->default(0);

    label - default( '' )

    inner_id - default( 0 )

    url - default( '' )

    image - default( '' )

    title - default( '' )

    text - default( '' )

    order - default( 0 )

    status - default( 0 )

     */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
