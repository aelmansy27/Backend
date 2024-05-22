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
        Schema::create('cow_feeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('cow_id');
            $table->foreignId('breadind_system_id');
            $table->foreignId('feed_stock_id');
            $table->decimal('amount');
            $table->decimal('actual_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cow_feeds');
    }
};
