<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            // Ubah enum jadi varchar/string
            $table->string('category', 50)->change();
        });
    }

    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            // Balikin ke enum kalau rollback (contoh enum lama)
            $table->enum('category', ['kopi','nonkopi'])->change();
        });
    }
};
