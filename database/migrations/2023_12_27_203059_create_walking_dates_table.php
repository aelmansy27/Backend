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
        Schema::create('walking_dates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('activity_system_id');
            $table->timestamp('walking_start')->nullable();
            $table->timestamp('walking_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('walking_dates');
    }
};
