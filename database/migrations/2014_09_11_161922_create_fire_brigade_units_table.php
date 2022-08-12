<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * @author Mariusz Waloszczyk
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @author Mariusz Waloszczyk
     */
    public function up(): void
    {
        Schema::create('fire_brigade_units', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->string('addr_street', 128);
            $table->string('addr_number', 16);
            $table->string('addr_postcode', 6);
            $table->string('addr_locality', 128);
            $table->foreignId('superior_unit_id')
                ->nullable()
                ->constrained('fire_brigade_units');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fire_brigade_units');
    }
};
