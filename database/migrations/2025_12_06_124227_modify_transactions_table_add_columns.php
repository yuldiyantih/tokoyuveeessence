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
        Schema::table('transactions', function (Blueprint $table) {
            // Mengubah nama kolom yang sudah ada
            $table->renameColumn('customer_name', 'name');
            $table->renameColumn('customer_phone', 'phone');
            $table->renameColumn('customer_address', 'address');
            $table->renameColumn('customer_email', 'email');

            // Menambahkan kolom baru
            $table->string('product_name')->after('address'); // Ditambahkan setelah kolom 'address'
            $table->integer('quantity')->after('product_name'); // Ditambahkan setelah kolom 'product_name'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Membatalkan perubahan (mengembalikan ke keadaan semula)
            $table->renameColumn('name', 'customer_name');
            $table->renameColumn('phone', 'customer_phone');
            $table->renameColumn('address', 'customer_address');
            $table->renameColumn('email', 'customer_email');

            // Menghapus kolom yang baru ditambahkan
            $table->dropColumn(['product_name', 'quantity']);
        });
    }
};
