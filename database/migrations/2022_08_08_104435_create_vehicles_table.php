<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @author Piotr Nagórny
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->string('number', 64)->primary();
            $table->string('name', 128);
            $table->foreignId('fire_brigade_unit_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @author Piotr Nagórny
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
