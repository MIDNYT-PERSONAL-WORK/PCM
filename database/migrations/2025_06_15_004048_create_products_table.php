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
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('sku');
            $table->text('description')->nullable();
            $table->enum('category_id',['Electronics','Accessories','Clothing','Home & Garden','Books','Sports & Outdoors','Beauty']);
            $table->decimal('price', 10, 2);
             $table->decimal('compare_price', 10, 2);
            $table->integer('weight')->nullable();
            $table->integer('stock')->nullable()->default(0);
            $table->string('images')->nullable();
            $table->string('upsell_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
