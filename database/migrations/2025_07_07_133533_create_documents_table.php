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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('government_id')->nullable();
            $table->string('proof_of_address')->nullable();
            $table->string('vehicle_registration')->nullable();
            $table->string('business_license')->nullable();
            $table->string('insurance_certificate')->nullable();
            $table->json('additional_documents')->nullable();
            $table->string('status_government_id')->default('pending'); // pending, approved, rejected
            $table->string('status_proof_of_address')->default('pending'); // pending, approved, rejected
            $table->string('status_vehicle_registration')->default('pending'); // pending, approved, rejected
            $table->string('status_business_license')->default('pending'); // pending, approved, rejected
            $table->string('status_insurance_certificate')->default('pending'); // pending, approved, rejected  
            $table->text('comments')->nullable(); // For admin comments or feedback
            $table->boolean('terms')->default(false);
            $table->boolean('privacy')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
