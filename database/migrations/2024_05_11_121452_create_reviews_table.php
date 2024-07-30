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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned(); // Utilisation de bigInteger avec unsigned
            $table->bigInteger('freelancer_id');
            $table->bigInteger('project_id')->unsigned(); // Assurez-vous que project_id est unsigned
            $table->longText('comment');
            $table->integer('rate')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Clé étrangère avec le bon type de données
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
