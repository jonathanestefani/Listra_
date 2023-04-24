<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->string('name', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('photo', 255)->nullable();
            $table->string('brand', 255)->nullable();
            $table->string('model', 255)->nullable();
            $table->integer('year')->nullable();
            $table->integer('mileage')->nullable();
            $table->string('gearbox_type', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->float('total');

            $table->timestamps();
            $table->dateTime('deleted_at', $precision = 0)->nullable();

            $table->index('brand');
            $table->index('model');
            $table->index('name');
            $table->index('description');
            $table->index('year');
            $table->index('mileage');
            $table->index('gearbox_type');
            $table->index('phone');
            $table->index('total');

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
