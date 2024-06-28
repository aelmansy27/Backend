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
        Schema::create('activity_systems', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('goal');
            $table->text('cause_of_creation');
            $table->text('description');
            $table->text('activities');
            $table->foreignId('breading_system_id');
            $table->dateTimeTz('sleep_time')->nullable();
            $table->dateTimeTz('wakeup_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_systems');
    }
};
