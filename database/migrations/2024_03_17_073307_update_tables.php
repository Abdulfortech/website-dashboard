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
        //$table->integer('order_counting')->default(0);
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('order_counting');
            $table->dropColumn('payment_counting');
        });
        
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('order_counting');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
