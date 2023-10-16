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
        Schema::create('rice_productions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pc_id'); //sub program category
            $table->string('seed_type');//inbred or hybrid
            $table->string('variety');//rice variety
            $table->date('dateharvested');//date harvested
            $table->string('season');//wet or dry
            $table->float('area_harvested');//area_harvested
            $table->float('area_planted');//area_planted
            $table->smallInteger('no_of_bags');//no of bags yield
            $table->float('averagekilo');//average per sack
            $table->float('farmgate_price');//farm gate price
            $table->float('yieldmt');//yield mt
            $table->foreign('pc_id')->references('pc_id')->on('program_category');
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
        Schema::dropIfExists('rice_productions');
    }
};
