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
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
                ->constrained();
            $table->string('role_suffix');
            $table->foreign('role_suffix')
                ->references('suffix')
                ->on('roles')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->comment('Roles assigned to each user.');
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
        Schema::dropIfExists('users_roles');
    }
};
