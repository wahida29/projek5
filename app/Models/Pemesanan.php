<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model

    {
        use HasFactory;

        /**
         * The table associated with the model.
         *
         * @var string
         */
        protected $table = 'pemesanan';

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'name',        // Customer name
            'menu',        // Menu name
            'quantity',    // Quantity ordered
            'phone',       // Customer phone
            'Harga',       // Total price of the menu
            'Pembayaran',  // Payment method
            'user_id',
            'bukti_transfer',
            'status'
        ];

        /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        protected $casts = [
            'Harga' => 'decimal:2', // Ensure the Harga field is cast to decimal with 2 decimal places
        ];
        public function user()
        {
            return $this->belongsTo(User::class);
        }
        public function menus()
        {
            return $this->hasMany(Pemesanan::class); // Sesuaikan dengan nama model menu
        }
}
