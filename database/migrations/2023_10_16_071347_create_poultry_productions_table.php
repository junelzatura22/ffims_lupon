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
        Schema::create('poultry_productions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pc_id'); //sub program category
            $table->date('daterecorded');//date harvested
            $table->smallInteger('no_of_heads');//no of heads
            $table->string('sizes');//no of sizes
            $table->float('no_of_pieces');//no of pieces
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
        Schema::dropIfExists('poultry_productions');
    }
};
