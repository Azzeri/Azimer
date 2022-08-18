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
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_histories', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->boolean('success');
            $table->timestamp('date');
            $table->string('login_ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @author Piotr Nagórny
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_histories');
    }
};
