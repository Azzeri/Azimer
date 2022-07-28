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
        Schema::create('resource_role', function (Blueprint $table) {
            $table->id();
            $table->string('resource_suffix');
            $table->foreign('resource_suffix')->references('suffix')->on('resources');
            $table->string('role_suffix');
            $table->foreign('role_suffix')->references('suffix')->on('roles');
            $table->json('actions');
            $table->comment('Resources assigned to roles. Actions determine exact operations that user can perform.');
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
        Schema::dropIfExists('resources_roles');
    }
};
