<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('from_user')->unsigned()->nullable();
            $table->bigInteger('to_user')->unsigned()->nullable();
            $table->bigInteger('from_section')->unsigned()->nullable();
            $table->bigInteger('to_section')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->string('content')->nullable();
            $table->string('date')->nullable();
            $table->string('is_read')->nullable();
            $table->string('read_timestemp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
