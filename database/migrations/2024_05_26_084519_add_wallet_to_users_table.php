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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('wallet')->default(0);
            $table->integer('total_earnings')->default(0);
            $table->integer('total_spent')->default(0);
            $table->integer('total_withdrawn')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('wallet');
            $table->dropColumn('total_earnings');
            $table->dropColumn('total_spent');
            $table->dropColumn('total_withdrawn');
        });
    }
};
