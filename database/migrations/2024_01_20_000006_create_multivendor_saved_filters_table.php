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
        Schema::create('tl_multivendor_saved_filters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buyer_id');
            $table->string('filter_name');
            $table->json('filter_data');
            $table->timestamps();
            
            $table->index('buyer_id', 'saved_filters_buyer_index');
            $table->index(['buyer_id', 'created_at'], 'saved_filters_buyer_created_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tl_multivendor_saved_filters');
    }
};
