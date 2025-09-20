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
        Schema::create('tl_multivendor_irec_redemptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('buyer_id');
            $table->string('redemption_reference')->unique(); // Unique reference for each redemption
            $table->decimal('quantity_mwh', 10, 2); // Amount being redeemed
            $table->decimal('remaining_quantity_mwh', 10, 2); // Remaining quantity after this redemption
            $table->string('redemption_purpose')->nullable(); // Purpose/reason for redemption
            $table->text('notes')->nullable(); // Additional notes
            $table->string('redemption_status')->default('pending'); // pending, approved, rejected
            $table->unsignedBigInteger('reviewed_by')->nullable(); // Admin who reviewed
            $table->timestamp('reviewed_at')->nullable();
            $table->text('review_notes')->nullable(); // Admin review notes
            $table->timestamps();

            // Indexes
            $table->index(['transaction_id', 'buyer_id']);
            $table->index('redemption_status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tl_multivendor_irec_redemptions');
    }
};
