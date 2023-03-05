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
        Schema::create('acl_resource_role', function (Blueprint $table) {
            $table->id();
            $table->string('role_suffix');
            $table->foreign('role_suffix')
                ->references('suffix')
                ->on('acl_roles');
            $table->string('resource_suffix');
            $table->foreign('resource_suffix')
                ->references('suffix')
                ->on('acl_resources');
            $table->enum('action', ['view', 'view_any', 'create', 'update', 'delete']);
            $table
                ->comment('Resources assigned to roles. Actions determine exact operations that user can perform.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @author Mariusz Waloszczyk
     */
    public function down(): void
    {
        Schema::dropIfExists('acl_resource_role');
    }
};
