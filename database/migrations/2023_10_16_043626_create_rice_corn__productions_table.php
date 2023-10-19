<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rice_corn__productions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('farm_id'); //farm id
            $table->string('seed_type');//inbred or hybrid
            $table->string('variety');//rice variety
            $table->date('dateharvested');//date harvested
            $table->string('season');//wet or dry
            $table->float('area_harvested');//area_harvested
            $table->float('area_planted');//area_planted
            $table->smallInteger('no_of_bags');//no of bags yield
            $table->smallInteger('averagekilo');//average per sack
            $table->float('farmgate_price');//farm gate price
            $table->float('yieldmt');//yield mt
            $table->foreign('farm_id')->references('farm_id')->on('farmactivity');
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
        Schema::dropIfExists('rice_corn__productions');
    }
};
