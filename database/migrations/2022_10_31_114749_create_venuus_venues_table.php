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
        Schema::create('venuus_venues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('venue_phone')->nullable();
            $table->integer('total_aps')->nullable();
            $table->string('public_ip')->nullable();
            $table->foreignId('geo_location_id')->nullable()->constrained('geo_locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venuus_venues');
    }
};
