<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tl_multivendor_irec_project_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('buyer_id');
            $table->decimal('quantity_mwh', 10, 2);
            $table->decimal('price_per_mwh', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->enum('transaction_status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->timestamp('transaction_date')->nullable();
            $table->timestamps();
            
            // Indexes with custom names
            $table->index('project_id', 'irec_trans_project_index');
            $table->index('buyer_id', 'irec_trans_buyer_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tl_multivendor_irec_project_transactions');
    }
};
