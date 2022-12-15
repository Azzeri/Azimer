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
        Schema::create('eq_usages', function (Blueprint $table) {
            $table->id();
            $table->text('description')
                ->nullable();
            $table->datetime('usage_start');
            $table->datetime('usage_end');
            $table->string('eq_item_code');
            $table->foreign('eq_item_code')
                ->references('code')
                ->on('eq_items');
            $table->foreignId('user_id')
                ->constrained();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @author Mariusz Waloszczyk
     */
    public function down(): void
    {
        Schema::dropIfExists('eq_usages');
    }
};
