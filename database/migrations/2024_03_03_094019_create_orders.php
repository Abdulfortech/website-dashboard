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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id');
            $table->integer('added_by');
            $table->string('department')->nullable();
            $table->string('order_code')->unique();
            $table->integer('client_id')->nullable();
            $table->string('order_type')->nullable();
            $table->string('client_name')->nullable();
            $table->text('client_address')->nullable();
            $table->string('client_phone')->nullable();
            $table->decimal('amount', 10, 2);
            $table->integer('item_quantity');
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->enum('payment_status', ['Unpaid', 'Paid-portion', 'Paid'])->default('Unpaid');
            $table->decimal('payment_balance', 10, 2)->default(0);
            $table->enum('status', ['Active', 'Pending', 'Completed', 'Cancelled'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
