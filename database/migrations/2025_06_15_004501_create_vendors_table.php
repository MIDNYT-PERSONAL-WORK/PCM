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
        // Main vendors table
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('company_name')->nullable();
            $table->text('address')->nullable();
            // $table->enum('status', ['active', 'suspended'])->default('active');
            $table->timestamps();
        });

        // Vendor reviews table
        Schema::create('vendor_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->integer('rating');
            $table->text('review')->nullable();
            $table->timestamps();
            
            // Ensure one review per customer per vendor per order
            $table->unique(['vendor_id', 'customer_id', 'order_id']);
        });

        // Vendor payment information table
        Schema::create('vendor_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
            $table->string('bank_name');
            $table->string('account_name');
            $table->string('account_number');
            $table->string('routing_number')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('iban')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
            
            // Only one primary payment method per vendor
            $table->unique(['vendor_id', 'is_primary']);
        });

        // Vendor payout history table
        Schema::create('vendor_payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('payment_method_id')->constrained('vendor_payments')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->decimal('fee', 10, 2)->default(0);
            $table->enum('status', ['pending', 'processed', 'failed', 'cancelled'])->default('pending');
            $table->string('reference')->nullable();
            $table->string('failure_reason')->nullable();
            $table->date('processed_at')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            
            // Index for faster lookups
            $table->index(['vendor_id', 'status']);
        });

        // Vendor notifications table
        Schema::create('vendor_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
            $table->string('type'); // e.g., 'order', 'payment', 'system'
            $table->string('title');
            $table->text('message');
            $table->json('data')->nullable(); // Additional structured data
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            
            // Index for unread notifications
            $table->index(['vendor_id', 'is_read']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_notifications');
        Schema::dropIfExists('vendor_payouts');
        Schema::dropIfExists('vendor_payments');
        Schema::dropIfExists('vendor_reviews');
        Schema::dropIfExists('vendors');
    }
};