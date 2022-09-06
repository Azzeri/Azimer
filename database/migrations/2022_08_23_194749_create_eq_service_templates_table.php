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
        Schema::create('eq_service_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description')
                ->nullable();
            $table->smallInteger('interval')
                ->unsigned();
            $table->foreignId('eq_item_category_id')
                ->constrained();
            $table->foreignId('manufacturer_id')
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @author Mariusz Waloszczyk
     */
    public function down(): void
    {
        Schema::dropIfExists('eq_service_templates');
    }
};
