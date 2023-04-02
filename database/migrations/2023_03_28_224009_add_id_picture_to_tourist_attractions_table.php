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
        // Schema::table('tourist_attractions', function (Blueprint $table) {
        //     $table->unsignedBigInteger('id_picture')->nullable();

        //     $table->foreign('id_picture')->references('id')->on('pictures')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tourist_attractions', function (Blueprint $table) {
            $table->dropForeign(['id_picture']);
            $table->dropColumn('id_picture');
        });
    }
};
