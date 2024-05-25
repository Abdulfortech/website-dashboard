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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('title')->nullable();
            $table->string('code')->nullable();
            $table->string('category')->nullable();
            $table->string('brand')->nullable();
            $table->string('department')->nullable();
            $table->string('quantity')->nullable();
            $table->string('cost')->nullable();
            $table->double('wholesalePrice')->nullable();
            $table->double('retailPrice')->nullable();
            $table->string('receivedDate')->nullable();
            $table->string('soldoutDate')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('title')->nullable();
            $table->string('code')->nullable();
            $table->string('category')->nullable();
            $table->string('department')->nullable();
            $table->string('price')->nullable();
            $table->string('image1')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables_for_services_products');
    }
};
