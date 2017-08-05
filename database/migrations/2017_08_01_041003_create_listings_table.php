<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->nullable()->unsigned();
            $table->string('title')->index();
            $table->string('type');
            $table->double('price');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->double('area')->nullable();
            $table->string('mls');
            $table->string('location')->nullable();
            $table->integer('address_id')->index();
            $table->text('description')->nullable();
            $table->string('status')->default('inactive');
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
        Schema::dropIfExists('listings');
    }
}
