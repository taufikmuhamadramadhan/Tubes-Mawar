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
        Schema::create('new_billing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_warnet');
            $table->foreignId('id_komputer');
            $table->foreignId('id_customer');
            $table->integer('billing');
            $table->date('exp_date');
            $table->double('harga');
            $table->timestamps();

            $table->foreign('id_warnet')->references('id_warnet')->on('warnet');
            $table->foreign('id_komputer')->references('id_komputer')->on('list_komputer');
            $table->foreign('id_customer')->references('id_customer')->on('customer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_billing');
    }
};
