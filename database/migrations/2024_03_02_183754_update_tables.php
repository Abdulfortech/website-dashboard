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
        Schema::table('products', function (Blueprint $table) {
            $table->integer('updated_by')->nullable();
        });
        
        Schema::table('services', function (Blueprint $table) {
            $table->integer('updated_by')->nullable();
        });
        
        Schema::table('departments', function (Blueprint $table) {
            $table->integer('updated_by')->nullable();
        });

        Schema::table('business', function (Blueprint $table) {
            $table->integer('updated_by')->nullable();
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->integer('updated_by')->nullable();
        });
        
        Schema::table('categories', function (Blueprint $table) {
            $table->integer('updated_by')->nullable();
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->integer('updated_by')->nullable();
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->integer('updated_by')->nullable();
        });
        
        Schema::table('employees', function (Blueprint $table) {
            $table->integer('updated_by')->nullable();
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
