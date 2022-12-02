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
        Schema::create('eq_services', function (Blueprint $table) {
            $table->id();
            $table->text('description')
                ->nullable();
            $table->date('expected_perform_date');
            $table->date('actual_perform_date')
                ->nullable();
            $table->string('eq_item_code');
            $table->foreign('eq_item_code')
                ->references('code')
                ->on('eq_items');
            $table->foreignId('eq_service_template_id')
                ->constrained();
            $table->foreignId('user_id')
                ->nullable()
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
        Schema::dropIfExists('eq_services');
    }
};
