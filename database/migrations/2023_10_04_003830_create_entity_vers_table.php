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
        Schema::create('entity_vers', function (Blueprint $table) {
            $table->id();
            $table->string('reg_type');
            $table->string('rsbsa_nat');
            $table->string('control_no');
            $table->string('rsbsa_loc');
            $table->string('fishr_nat');
            $table->string('fishr_loc');
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');
            $table->string('extname');
            $table->string('dob');
            $table->string('pob');
            $table->string('gender');
            $table->string('a_barangay');
            $table->string('a_citymun');
            $table->string('a_province');
            $table->string('a_region');
            $table->string('contactno');
            $table->string('is_loaded');
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
        Schema::dropIfExists('entity_vers');
    }
};
