<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('menus', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nama menu
        $table->text('description')->nullable(); // Deskripsi menu (opsional)
        $table->enum('category', ['makanan', 'minuman']); // Kategori menu
        $table->decimal('price', 10, 2); // Harga menu
        $table->string('image')->nullable(); // Path gambar menu
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
