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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cow_id');
            $table->string('name');
            $table->foreignId('treatment_stock_id'); //name of treatment stock that contain name + dose as gm + type as method
            $table->text('disease');
            $table->integer('doses'); //counter
            $table->longText('diagnose');  // maybe in additional info
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
