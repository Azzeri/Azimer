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
        Schema::create('eq_items', function (Blueprint $table) {
            $table->string('code', 32)
                ->primary();
            $table->string('name', 255);
            $table->boolean('is_activated')
                ->default(false);
            $table->foreignId('eq_item_template_id')
                ->constrained();
            $table->foreignId('fire_brigade_unit_id')
                ->constrained();
            $table->string('vehicle_number');
            $table->foreign('vehicle_number')
                ->nullable()
                ->references('number')
                ->on('vehicles');
            $table->string('construction_number')
                ->nullable();
            $table->string('inventory_number')
                ->nullable();
            $table->string('identification_number')
                ->nullable();
            $table->date('date_expiry')
                ->nullable();
            $table->date('date_legalisation')
                ->nullable();
            $table->date('date_legalisation_due')
                ->nullable();
            $table->date('date_production')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @author Mariusz Waloszczyk
     */
    public function down(): void
    {
        Schema::dropIfExists('eq_items');
    }
};
