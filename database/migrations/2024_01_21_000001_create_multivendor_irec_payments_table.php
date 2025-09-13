<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tl_multivendor_irec_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buyer_id');
            $table->unsignedBigInteger('transaction_id');
            $table->string('bank_name');
            $table->string('iban');
            $table->string('account_number');
            $table->string('account_holder_name');
            $table->string('receipt_path')->nullable();
            $table->enum('payment_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Foreign key constraints
//            $table->foreign('buyer_id')->references('id')->on('tl_users')->onDelete('cascade');
//            $table->foreign('transaction_id')->references('id')->on('tl_multivendor_irec_project_transactions')->onDelete('cascade');
//            $table->foreign('reviewed_by')->references('id')->on('tl_users')->onDelete('set null');
            
            // Indexes
            $table->index('buyer_id', 'irec_payment_buyer_index');
            $table->index('transaction_id', 'irec_payment_transaction_index');
            $table->index('payment_status', 'irec_payment_status_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tl_multivendor_irec_payments');
    }
};
