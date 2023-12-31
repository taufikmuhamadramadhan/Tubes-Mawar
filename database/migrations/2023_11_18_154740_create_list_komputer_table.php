<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListKomputerTable extends Migration
{
    public function up()
    {
        Schema::create('list_komputer', function (Blueprint $table) {
            $table->id('id_komputer');
            $table->foreignId('id_warnet');
            $table->string('nama_komputer');
            $table->string('processor');
            $table->string('ram');
            $table->string('gpu');
            $table->double('harga'); // Added new column 'harga'
            $table->timestamps();

            $table->foreign('id_warnet')->references('id_warnet')->on('warnet');
        });
    }

    public function down()
    {
        Schema::table('billing', function (Blueprint $table) {
            $table->dropForeign(['id_komputer']);
        });
        Schema::dropIfExists('list_komputer');
    }
}
