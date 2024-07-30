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
        Schema::create('project_files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('path');
            $table->string('file_type');
            $table->string('file_size');
            $table->foreignId('project_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('freelancer_id');
            $table->unsignedBigInteger('added_by_user_id');
            $table->timestamps();

            // foreign keys
            $table->foreign('added_by_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_files');
    }
};
