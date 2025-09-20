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
        Schema::table('tl_multivendor_irec_project_transactions', function (Blueprint $table) {
            // Add redemption tracking fields
            $table->decimal('redeemed_quantity_mwh', 10, 2)->default(0)->after('total_amount');
            $table->decimal('remaining_quantity_mwh', 10, 2)->nullable()->after('redeemed_quantity_mwh');
            
            // Add index for redemption queries
            $table->index(['transaction_status', 'remaining_quantity_mwh'], 'irec_trans_redemption_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tl_multivendor_irec_project_transactions', function (Blueprint $table) {
            $table->dropIndex('irec_trans_redemption_index');
            $table->dropColumn(['redeemed_quantity_mwh', 'remaining_quantity_mwh']);
        });
    }
};
