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
            $table->foreignId('eq_item_template_id')->constrained();
            $table->string('name', 64);
            $table->text('description', 2048)->nullable();
            $table->smallInteger('interval')->unsigned();
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
