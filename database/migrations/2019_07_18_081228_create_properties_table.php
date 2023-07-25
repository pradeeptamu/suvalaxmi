<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('purpose',['sell','rent']);
            $table->enum('type',['residential','commercial']);
            $table->enum('category',['house','land','apartment']);
            $table->boolean('status')->default(0);
            $table->string('address', 100);//home number and street number
            $table->string('location', 30);
            $table->longText('images');
            $table->string('thumbnail');
            $table->string('title', 100);
            $table->text('description');
            //area
            $table->float('area_total');
            $table->float('area_built')->nullable();
            $table->string('face', 25);
            //road
            $table->float('road_size');
            $table->string('road_type', 25);
            //price
            $table->bigInteger('price');
            $table->string('price_unit', 25)->nullable();
            $table->integer('views')->nullable();

            //owner details
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('properties');
    }
}
