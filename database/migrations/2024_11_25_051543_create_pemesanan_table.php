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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary Key
            $table->string('name', 255); // Customer Name
            $table->string('menu', 255); // Menu Name
            $table->integer('quantity'); // Quantity
            $table->string('phone', 255)->nullable(); // Phone Number
            $table->integer('Harga'); // Total Price
            $table->enum('Pembayaran', ['Cash', 'Transfer']);
            $table->string('bukti_transfer')->nullable();  // Kolom bukti transfer, nullable karena hanya diperlukan jika pembayaran Transfer// Payment Method
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
