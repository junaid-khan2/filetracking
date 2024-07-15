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
            $table->bigInteger('last_modify_by')->unsigned()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('from_section')->unsigned()->nullable();
            $table->bigInteger('to_section')->unsigned()->nullable();
            $table->bigInteger('letter_id')->unsigned()->nullable();
            $table->string('reference_no')->nullable();
            $table->string('letter_no')->nullable();
            $table->string('file_type')->nullable();
            $table->string('belt_no')->nullable();
            $table->string('name')->nullable();
            $table->string('flag')->nullable();
            $table->string('source')->nullable();
            $table->string('prefix')->nullable();
            $table->string('track_number')->nullable();
            $table->string('date')->nullable();
            $table->string('letter_date')->nullable();
            $table->string('subject')->nullable();
            $table->text('content')->nullable();
            $table->string('current_section')->nullable();
            $table->string('no_of_pages')->nullable();
            $table->string('status')->nullable();
            $table->string('file_no')->nullable();
            $table->string('dead_line')->nullable();
            $table->string('file_name')->nullable();
            $table->integer('track_count')->nullable();
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
