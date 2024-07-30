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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('image')->default('projects_default.png');
            // $table->bigInteger('category_id');
            // $table->bigInteger('user_id');
            $table->date('deadline');
            // budget type
            $table->string('budget_type')->default('fixed');
            $table->integer('budget')->default(0);
            $table->integer('max_budget')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();

            // foreign key
            $table->foreignId('user_id')->constrained();
            $table->foreignId('category_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
