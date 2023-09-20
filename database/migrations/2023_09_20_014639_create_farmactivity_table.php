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
        Schema::create('farmactivity', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('program_id'); //program id
            $table->unsignedInteger('pc_id'); //sub program category
            $table->float('area');
            $table->smallInteger('hills');
            $table->smallInteger('no_of_heads');
            $table->string('farmtype', 25);
            $table->string('is_organic', 3);
            $table->text('remarks');
            $table->unsignedBigInteger('register_by');
            $table->unsignedBigInteger('farm_id');
            $table->foreign('program_id')->references('program_id')->on('program');
            $table->foreign('pc_id')->references('pc_id')->on('program_category');
            $table->foreign('register_by')->references('id')->on('users');
            $table->foreign('farm_id')->references('id')->on('farmdetails');
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
        Schema::dropIfExists('farmactivity');
    }
};
