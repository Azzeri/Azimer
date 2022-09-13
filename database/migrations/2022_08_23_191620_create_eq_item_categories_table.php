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
        Schema::create('eq_item_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->string('photo_path', 255)
                ->default('/images/default.png');
            $table->boolean('is_fillable')
                ->default(false);
            $table->foreignId('parent_category_id')
                ->nullable()
                ->constrained('eq_item_categories')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @author Mariusz Waloszczyk
     */
    public function down(): void
    {
        Schema::dropIfExists('eq_item_categories');
    }
};
