<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->foreignId('id_user')->references('id')->on('users');
            $table->foreignId('id_room')->references('id')->on('rooms');
            $table->foreignId('id_payment')->references('id')->on('payments');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};