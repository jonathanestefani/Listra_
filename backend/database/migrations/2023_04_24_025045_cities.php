<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->string('name');
            $table->string('uf', 2);
            $table->string('ibge', 11)->nullable();
            $table->string('ddd', 3)->nullable();
            $table->timestamps();
            $table->dateTime('deleted_at', $precision = 0)->nullable();

            $table->index('uf');
            $table->index('ibge');
            $table->index('ddd');

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('uf')->references('uf')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
};
