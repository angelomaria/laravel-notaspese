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
        Schema::create('has_team', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_team');
            $table->foreignId('id_user');
            $table->foreign('id_team')->references('id')->on('team')
                ->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('has_team');
    }
};
