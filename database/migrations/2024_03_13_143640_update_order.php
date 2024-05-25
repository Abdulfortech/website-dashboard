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
        //
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('amount');
            $table->dropColumn('item_quantity');
            $table->dropColumn('payment_balance');
            $table->integer('quantity')->nullable();
            $table->double('subtotal', 20, 3)->nullable();
            $table->double('deposit', 20, 3)->nullable();
            $table->double('balance', 20, 3)->nullable();
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
