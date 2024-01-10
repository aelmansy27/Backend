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
        Schema::create('eating_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cowfeed_id');
            $table->dateTimeTz('eating_start')->nullable();
            $table->dateTimeTz('eating_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eating_dates');
    }
};
