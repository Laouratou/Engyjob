<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
public function up(): void
{
    Schema::create('memberships', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('invoice_code');
        $table->date('purchase_date');
        $table->date('expiry_date');
        $table->bigInteger('price');
        $table->bigInteger('user_id')->unsigned();
        $table->string('user_type');
        $table->string('payment_method');
        $table->enum('periodicity', ['monthly', 'yearly'])->default('monthly');
        $table->boolean('is_active')->default(true);
        $table->boolean('is_cancelled')->default(false);
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
