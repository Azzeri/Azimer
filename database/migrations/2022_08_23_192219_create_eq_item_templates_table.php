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
        Schema::create('eq_item_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->foreignId('eq_item_category_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('vehicle_number');
            $table->foreignId('manufacturer_id')
                ->constrained();
            $table->boolean('construction_number')
                ->default(false);
            $table->boolean('inventory_number')
                ->default(false);
            $table->boolean('identification_number')
                ->default(false);
            $table->boolean('date_expiry')
                ->default(false);
            $table->boolean('date_legalisation')
                ->default(false);
            $table->boolean('date_legalisation_due')
                ->default(false);
            $table->boolean('date_production')
                ->default(false);
            $table->comment('Table determining item properties.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @author Mariusz Waloszczyk
     */
    public function down(): void
    {
        Schema::dropIfExists('eq_item_templates');
    }
};
