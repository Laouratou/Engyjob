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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('price');
            $table->bigInteger('number_delivery_days');
            $table->longText('letter_cover');
            $table->boolean('is_sticky')->default(false);
            $table->boolean('is_hidden')->default(false);
            $table->boolean('is_active')->default(true);
            $table->foreignId('project_id')->constrained();
            $table->foreignId('user_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
