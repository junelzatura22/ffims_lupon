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
        Schema::create('farmdetails', function (Blueprint $table) {
            $table->id();
            $table->string('farm_name');
            $table->smallInteger('no_of_parcel');
            $table->float('total_area');
            $table->string('ownership_type');
            $table->string('name_of_owner');
            $table->string('lat');
            $table->string('long');
            $table->string('is_rotation')->default('Yes');
            $table->string('farm_status')->default('Active');
            $table->string('name_rotation_farmer');
            $table->unsignedBigInteger('registered_to');
            $table->unsignedBigInteger('created_by'); 
            $table->foreign('registered_to')->references('ff_id')->on('farmerfisherfolk');
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('farmdetails');
    }
};
