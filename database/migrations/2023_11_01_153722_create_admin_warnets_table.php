<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminWarnetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop the table if it exists
        Schema::dropIfExists('admin_warnets');

        // Create the table
        Schema::create('admin_warnets', function (Blueprint $table) {
            $table->id('id_adminWarnet');
            $table->foreignId('id_warnet');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nameWarnet')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_warnet')->references('id_warnet')->on('warnet');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_warnets');
    }
}
