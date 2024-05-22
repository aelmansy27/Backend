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
            $table->id();
            $table->string('cowId',6)->unique();
            $table->foreignId('activityplace_id');
            $table->foreignId('activitysystem_id');
            $table->foreignId('breadingsystem_id');
            $table->foreignId('purpose_id');
            $table->string('original_area');
            $table->string('appearance');
            $table->string('image');
            $table->enum('gender',['heifer','bull']);
            $table->dateTimeTz('birthday_date')->nullable();
            $table->dateTimeTz('entrance_date')->nullable();
            $table->integer('age')->nullable();
            $table->decimal('weight');
            $table->decimal('milk_amount_morning')->nullable();
            $table->decimal('milk_amount_afternoon')->nullable();
            $table->decimal('latitude')->nullable();
            $table->decimal('longitude')->nullable();
            $table->boolean('cow_status')->default(true);
            $table->boolean('is_pregnant')->default(false);
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
