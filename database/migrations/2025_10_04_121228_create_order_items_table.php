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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->references('id')->on('products')->nullOnDelete();
            // copy from product for if product is deleted or updated (product and price)
            $table->string('product_name');
            $table->string('sku') ; // option is exists it
            $table->float('price');
            $table->unsignedSmallInteger('quantity')->default(1);
            $table->json('options')->nullable(); // attribute of product
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
