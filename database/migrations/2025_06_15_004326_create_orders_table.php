<?php

use App\Models\OrderItems;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('orders', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('order_number')->unique();
        //     $table->string('customer_name');
        //     $table->string('phone');
        //     $table->foreignId('product_id')->constrained()->onDelete('cascade');
        //     $table->integer('quantity');
        //     $table->decimal('amount', 10, 2);
        //     $table->decimal('delivery_fee', 10, 2)->nullable();
        //     $table->text('location');
        //     $table->string('city');
        //     $table->enum('source', ['facebook', 'website', 'manual'])->default('website');
        //     $table->enum('payment_mode', ['credit_card', 'debit_card', 'cash_on_delivery', 'bank_transfer', 'momo'])->default('cash_on_delivery');
        //     $table->enum('status', ['pending', 'confirmed', 'delivered', 'postponed', 'cancelled', 'travelled'])->default('pending');
        //     $table->foreignId('operator_id')->nullable()->constrained('users')->nullOnDelete();
        //     $table->foreignId('rider_id')->nullable()->constrained('users')->nullOnDelete();
        //     $table->string('delivery_code')->nullable();
        //     $table->timestamps();
        // });
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('customer_name');
            $table->string('phone');
            $table->text('location');
            $table->string('city');
            $table->decimal('subtotal', 10, 2); // Products total before delivery
            $table->decimal('delivery_fee', 10, 2)->nullable();
            $table->decimal('amount', 10, 2); // Subtotal + delivery
            $table->enum('source', ['facebook', 'website', 'manual'])->default('website');
            $table->enum('payment_mode', ['credit_card', 'debit_card', 'cash_on_delivery', 'bank_transfer', 'momo'])->default('cash_on_delivery');
            $table->enum('status', ['pending', 'confirmed', 'delivered', 'postponed', 'cancelled', 'travelled'])->default('pending');
            $table->foreignId('operator_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('rider_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('delivery_code')->nullable();
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
