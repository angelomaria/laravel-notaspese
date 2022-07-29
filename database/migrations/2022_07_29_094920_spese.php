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
        Schema::create('spese', function (Blueprint $table) {
            $table->id();
            $table->string('description', 200);
            $table->foreignId('account');
            $table->unsignedDecimal('amount', $precision = 8, $scale = 2);
            $table->boolean('pay');
            $table->string('note', 200)->nullable();
            $table->foreignId('created_by');
            $table->foreignId('updated_by');
            $table->foreign('account')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')
                ->onDelete('cascade');
            $table->timestamps($precision = 0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spese');
    }
};
