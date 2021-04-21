<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Database\Migrations;

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
            $table->string('name')->index();
            $table->string('age')->nullable();
            $table->date('last_visit')->nullable();
            $table->integer('species_id')->unsigned()->nullable();
            $table->integer('breed_id')->unsigned()->nullable();
            $table->foreign('species_id')->references('id')->on('species');
            $table->foreign('breed_id')->references('id')->on('breeds');
        });
    }
}
