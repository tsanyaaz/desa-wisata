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
        Schema::create('tourist_attractions', function (Blueprint $table) {
            $table->id();
            $table->string('ta_name', 255);
            $table->text('ta_desc');
            $table->unsignedBigInteger('id_tourism_category');
            $table->text('ta_facilities');
            $table->timestamps();

            $table->foreign('id_tourism_category')->references('id')->on('tourism_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourist_attractions');
    }
};
