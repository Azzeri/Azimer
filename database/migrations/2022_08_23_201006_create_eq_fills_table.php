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
        Schema::create('eq_fills', function (Blueprint $table) {
            $table->id();
            $table->datetime('started_at');
            $table->datetime('finished_at');
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
        Schema::dropIfExists('eq_fills');
    }
};
