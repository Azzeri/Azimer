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
            $table->foreignId('eq_item_category_id')->constrained('eq_item_categories');
            $table->foreignId('manufacturer_id')->constrained();
            $table->boolean('has_name')->default(false);
            $table->boolean('has_construction_number')->default(false);
            $table->boolean('has_inventory_number')->default(false);
            $table->boolean('has_identification_number')->default(false);
            $table->boolean('has_date_production')->default(false);
            $table->boolean('has_date_expiry')->default(false);
            $table->boolean('has_date_legalisation')->default(false);
            $table->boolean('has_date_legalisation_due')->default(false);
            $table->boolean('has_vehicle')->default(false);
            $table->boolean('is_fillable')->default(false);
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
