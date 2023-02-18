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
        Schema::create('acl_roles', function (Blueprint $table) {
            $table->string('suffix', 64)->primary();
            $table->comment('Roles which group resources.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @author Mariusz Waloszczyk
     */
    public function down(): void
    {
        Schema::dropIfExists('acl_roles');
    }
};
