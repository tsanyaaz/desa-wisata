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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_customer'); //id customer
            $table->unsignedBigInteger('id_tourpackage'); //id tour package
            $table->datetime('reservation_date'); //tanggal reservasi
            $table->integer('reservation_price'); //harga
            $table->integer('reservation_qty'); //jumlah peserta
            $table->decimal('reservation_discount', 10, 0); //diskon
            $table->float('discount_value'); //nilai diskon
            $table->bigInteger('reservation_total'); //total harga
            $table->text('tf_receiptfile'); //file bukti transfer
            $table->enum('reservation_status', ['Pesan', 'Dibayar', 'Selesai']); //status reservasi
            $table->timestamps();

            $table->foreign('id_customer')->references('id')->on('customers');
            $table->foreign('id_tourpackage')->references('id')->on('tour_packages');
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
