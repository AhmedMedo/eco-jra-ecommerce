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
        Schema::create('tl_multivendor_irec_cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buyer_id');
            $table->unsignedBigInteger('project_id');
            $table->string('uid')->unique(); // Unique identifier for cart item
            $table->decimal('quantity_mwh', 10, 2);
            $table->decimal('price_per_mwh', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->json('project_snapshot')->nullable(); // Store project data at time of adding to cart
            $table->timestamps();
            
            // Indexes
            $table->index('buyer_id', 'irec_cart_buyer_index');
            $table->index('project_id', 'irec_cart_project_index');
            $table->index(['buyer_id', 'project_id'], 'irec_cart_buyer_project_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tl_multivendor_irec_cart_items');
    }
};
