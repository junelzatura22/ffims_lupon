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
        Schema::create('high_value_productions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pc_id'); //sub program category
            $table->date('daterecorded');//date harvested
            $table->float('area_planted');//area planted
            $table->float('area_harvested');//no of area harvested
            $table->float('no_of_kilos');//no of kilos
            $table->float('farmgate_price');//farm gate price
            $table->float('yieldmt');//yield mt
            $table->string('type_of_harvest');//Type of harvest
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
        Schema::dropIfExists('high_value_productions');
    }
};
