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
        Schema::create('homestays', function (Blueprint $table) {
            $table->id();
            $table->string('h_name');
            // $table->unsignedBigInteger('id_picture')->nullable();
            $table->text('h_desc');
            $table->string('h_facilities');
            $table->timestamps();

            // $table->foreign('id_picture')->references('id')->on('pictures')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homestays');
    }
};
