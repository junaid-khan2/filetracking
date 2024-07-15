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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('letter_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('created_section')->nullable();
            $table->string('letter_no')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('subject')->nullable();
            $table->string('date')->nullable();
            $table->text('content')->nullable();
            $table->string('flag')->nullable();
            $table->string('status')->nullable();
            $table->string('dead_line')->nullable();
            $table->integer('track_count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
