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
     *  * @author Mariusz Waloszczyk
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->string('suffix', 64)->primary();
            $table->string('name', 64);
            $table->comment('Roles which group resources.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @author Mariusz Waloszczyk
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
