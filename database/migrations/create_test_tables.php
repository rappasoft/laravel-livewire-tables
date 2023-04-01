<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('breeds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('species_id')->unsigned();
            $table->foreign('species_id')->references('id')->on('species');
        });

        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->integer('sort')->default(0);
            $table->string('name')->index();
            $table->string('age')->nullable();
            $table->date('last_visit')->nullable();
            $table->integer('species_id')->unsigned()->nullable();
            $table->integer('breed_id')->unsigned()->nullable();
            $table->foreign('species_id')->references('id')->on('species');
            $table->foreign('breed_id')->references('id')->on('breeds');
        });

        Schema::create('veterinaries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('phone')->index();
        });

        Schema::create('pet_veterinary', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained();
            $table->foreignId('veterinary_id')->constrained();
        });
    }
}
