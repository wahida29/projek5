<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBuktiTransferToPesanansTable extends Migration
{
    /**
     * Jalankan migrasi untuk menambahkan kolom baru.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pemesanan', function (Blueprint $table) {
            // Menambahkan kolom baru untuk bukti transfer
            $table->string('bukti_transfer')->nullable(); // Kolom ini bisa null
        });
    }

    /**
     * Membatalkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemesanan', function (Blueprint $table) {
            // Menghapus kolom yang baru ditambahkan
            $table->dropColumn('bukti_transfer');
        });
    }
}
