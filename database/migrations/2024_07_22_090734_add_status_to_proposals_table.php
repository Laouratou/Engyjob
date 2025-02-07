<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->string('status')->nullable(); // or other data type/constraints as needed
        });
    }
    
    public function down()
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
    
};
