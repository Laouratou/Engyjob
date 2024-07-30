<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // Identifiant unique pour chaque transaction
            $table->string('transaction_id')->unique(); // Identifiant de la transaction
            $table->decimal('amount', 10, 2); // Montant de la transaction
            $table->string('description'); // Description de la transaction
            $table->string('customer'); // Identifiant du client ou numéro de client
            $table->string('status')->default('pending'); // Statut de la transaction (ex: pending, completed, failed)
            $table->timestamps(); // Créé automatiquement les colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
