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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id')->nullable();
            $table->integer('added_by')->nullable();
            $table->string('department')->nullable();
            $table->string('title')->nullable();
            $table->double('amount', 20, 3)->nullable();
            $table->string('date')->nullable();
            $table->string('note')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });

        Schema::create('wages', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id')->nullable();
            $table->integer('added_by')->nullable();
            $table->string('department')->nullable();
            $table->integer('employee_id')->nullable();
            $table->string('type')->nullable();
            $table->string('method')->nullable();
            $table->double('amount',20,3)->nullable();
            $table->integer('date')->nullable();
            $table->integer('note')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
