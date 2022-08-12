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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->string('tel')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('vat', 15);
            $table->integer('coeff_redditivita');
            $table->integer('perc_contributi');
            $table->string('business_name', 255)->nullable();
            $table->integer('age')->nullable();
            $table->string('address', 200)->nullable();
            $table->string('bio', 500)->nullable();
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
        Schema::dropIfExists('users');
    }
};
