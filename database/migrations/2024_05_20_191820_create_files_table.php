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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('created_section')->unsigned()->nullable();
            $table->bigInteger('file_type_id')->unsigned()->nullable();
            $table->bigInteger('mester_file_id')->unsigned()->nullable();
            $table->bigInteger('flag_id')->unsigned()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('section_id')->unsigned()->nullable();
            $table->string('track_number')->nullable();
            $table->string('date')->nullable();
            $table->string('subject')->nullable();
            $table->text('content')->nullable();
            $table->string('current_status')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
