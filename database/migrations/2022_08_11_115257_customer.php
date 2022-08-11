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
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('denominazione', 300);
            $table->string('vat', 15)->nullable();
            $table->string('fiscal_code', 16)->nullable();
            $table->string('paese');
            $table->string('cap')->nullable();
            $table->string('province')->nullable();
            $table->string('comune')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('pec')->nullable();
            $table->string('cell')->nullable();
            $table->string('cod_sdi')->nullable();
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
        Schema::dropIfExists('customer');
    }
};
