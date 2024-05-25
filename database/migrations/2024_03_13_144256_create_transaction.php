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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('added_by')->nullable();
            $table->integer('business_id')->nullable();
            $table->string('type')->nullable();
            $table->string('category')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('expense_id')->nullable();
            $table->integer('wage_id')->nullable();
            $table->double('amount')->nullable();
            $table->string('note')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
