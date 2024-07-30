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
        Schema::create('user_payments', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->bigInteger('user_id')->unsigned(); // Utilisation de bigInteger avec unsigned
            $table->bigInteger('freelancer_id');
            $table->bigInteger('project_id');
            $table->bigInteger('etape_cle_id')->nullable();
            $table->string('payment_method');
            $table->float('amount');
            $table->enum('status', ['success', 'refunded'])->default('success');

            // Clé étrangère avec le bon type de données
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           
           
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_payments');
    }
};
