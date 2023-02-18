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
        Schema::create('acl_role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained();
            $table->string('role_suffix');
            $table->foreign('role_suffix')
                ->references('suffix')
                ->on('acl_roles');
            $table->comment('Roles assigned to each user.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @author Mariusz Waloszczyk
     */
    public function down(): void
    {
        Schema::dropIfExists('acl_role_user');
    }
};
