<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::table('profils', function (Blueprint $table) {
            // Vérifier si les colonnes existent déjà avant de les ajouter
            if (!Schema::hasColumn('profils', 'prix')) {
                $table->string('prix')->default('0');
            }

            if (!Schema::hasColumn('profils', 'freelancer_type_id')) {
                // Ajouter la colonne avec la clé étrangère
                $table->foreignId('freelancer_type_id')->default(1)->constrained()->onDelete('cascade');
            }

            if (!Schema::hasColumn('profils', 'category_id')) {
                // Ajouter la colonne avec la clé étrangère nullable
                $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            }
        });
    }

   
    public function down(): void
    {
        Schema::table('profils', function (Blueprint $table) {
            // Supprimer les colonnes ajoutées lors de la migration up
            $table->dropColumn('prix');
            $table->dropColumn('freelancer_type_id');
            $table->dropColumn('category_id');
        });
    }
};
