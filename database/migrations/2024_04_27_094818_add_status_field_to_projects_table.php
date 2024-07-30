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
        Schema::table('projects', function (Blueprint $table) {
            // freelancer_id
            $table->bigInteger('freelancer_id')->nullable();
            // status
            $table->enum('status', ['pending', 'ongoing', 'completed', 'canceled', 'expired'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('freelancer_id');
            $table->dropColumn('status');
        });
    }
};