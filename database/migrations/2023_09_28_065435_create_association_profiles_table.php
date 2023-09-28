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
        Schema::create('association_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('assoc_id');
            $table->unsignedBigInteger('entity');
            $table->unsignedBigInteger('register_by');
            $table->string("membersince");
            $table->string("status")->default('Active');
            $table->foreign('assoc_id')->references('as_id')->on('association');
            $table->foreign('entity')->references('ff_id')->on('farmerfisherfolk');
            $table->foreign('register_by')->references('id')->on('users');
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
        Schema::dropIfExists('association_profiles');
    }
};
