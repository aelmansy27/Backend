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
        Schema::create('cows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cow_id',6)->unique();
            $table->foreignId('activityplace_id');
            $table->foreignId('activitysystem_id');
            $table->string('original_area');
            $table->enum('sex',['heifer','bull']);
            $table->timestamp('entrance_date')->nullable();
            $table->timestamp('age')->nullable();
            $table->timestamp('sleep_hour')->nullable();
            $table->timestamp('eating_duration')->nullable();
            $table->timestamp('laydown_duration')->nullable();
            $table->decimal('milk_amount');
            $table->decimal('heart_rate');
            $table->decimal('pressure');
            $table->decimal('temperature');
            $table->decimal('sugar_rate');
            $table->decimal('distance');
            $table->decimal('eating_amount');
            $table->decimal('jaw_movement_rate');
            $table->decimal('movement_rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cows');
    }
};
