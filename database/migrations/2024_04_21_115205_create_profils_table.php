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
        Schema::create('profils', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('freelancer_type_id')->nullable(); // Peut être nul si nécessaire

            // Autres colonnes
            $table->string('photo')->default('profil_default.svg');
            $table->date('date_naissance')->nullable();
            $table->string('fonction')->nullable();
            $table->string('domaine_activite')->nullable();
            $table->longText('apercu')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('behance')->nullable();
            $table->string('website')->nullable();
            $table->string('ville')->nullable();
            $table->string('province')->nullable();
            $table->string('code_postal')->nullable();
            $table->string('pays')->default('Burkina Faso');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('freelancer_type_id')->references('id')->on('freelancer_types')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profils');
    }
};
