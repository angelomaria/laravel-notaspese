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
        Schema::create('envoice', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer');
            $table->decimal('amount');
            $table->decimal('bollo');
            $table->decimal('cassa');
            $table->boolean('pay');
            $table->foreignId('team');
            $table->string('note', 200)->nullable();
            $table->timestamp('envoice_created_at', $precision = 0);
            $table->timestamp('envoice_pay', $precision = 0)->nullable();
            $table->timestamps($precision = 0);
            $table->softDeletes();
            $table->foreign('customer')->references('id')->on('customer')
                ->onDelete('cascade');
            $table->foreign('team')->references('id')->on('team')
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
        Schema::dropIfExists('envoice');
    }
};
