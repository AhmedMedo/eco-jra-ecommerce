<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('tl_users')) {
            Schema::table('tl_users', function (Blueprint $table) {
                $table->string('first_name')->nullable()->after('name');
                $table->string('last_name')->nullable()->after('first_name');
                $table->string('company_name')->nullable()->after('last_name');
                $table->string('phone')->nullable()->after('company_name');
                $table->string('vat_number')->nullable()->after('phone');
                $table->enum('account_status', ['pending', 'approved', 'rejected'])->default('pending')->after('vat_number');
                $table->text('kyc_notes')->nullable()->after('account_status');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('tl_users')) {
            Schema::table('tl_users', function (Blueprint $table) {
                if (Schema::hasColumn('tl_users', 'first_name')) {
                    $table->dropColumn('first_name');
                }
                if (Schema::hasColumn('tl_users', 'last_name')) {
                    $table->dropColumn('last_name');
                }
                if (Schema::hasColumn('tl_users', 'company_name')) {
                    $table->dropColumn('company_name');
                }
                if (Schema::hasColumn('tl_users', 'phone')) {
                    $table->dropColumn('phone');
                }
                if (Schema::hasColumn('tl_users', 'vat_number')) {
                    $table->dropColumn('vat_number');
                }
                if (Schema::hasColumn('tl_users', 'account_status')) {
                    $table->dropColumn('account_status');
                }
                if (Schema::hasColumn('tl_users', 'kyc_notes')) {
                    $table->dropColumn('kyc_notes');
                }
            });
        }
    }
};
