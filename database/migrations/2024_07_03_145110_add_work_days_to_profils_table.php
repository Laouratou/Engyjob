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
        Schema::table('profils', function (Blueprint $table) {
            $table->string('work_days')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('profils', function (Blueprint $table) {
            $table->dropColumn('work_days');
        });
    }
    
};
