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
        Schema::create('customers', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('company_name')->nullable();
            $table->integer('username')->nullable();
            $table->integer('phone')->nullable();
            $table->string('region')->nullable();
            $table->integer('total_users')->nullable();
            $table->string('plan')->nullable();
            $table->string('total_aps')->nullable();
            $table->string('creationdate')->nullable();
            $table->string('plan_expiration')->nullable();
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
        Schema::dropIfExists('customers');
    }
};
