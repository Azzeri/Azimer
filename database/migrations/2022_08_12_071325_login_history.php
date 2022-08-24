<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * @author Piotr Nagórny
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @author Piotr Nagórny
     */
    public function up(): void
    {
        Schema::create('login_histories', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->boolean('success');
            $table->datetime('date');
            $table->string('login_ip', 15);
            $table->string('browser');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @author Piotr Nagórny
     */
    public function down(): void
    {
        Schema::dropIfExists('login_histories');
    }
};
