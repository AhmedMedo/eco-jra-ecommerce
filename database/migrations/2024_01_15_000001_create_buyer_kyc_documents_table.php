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
        if (!Schema::hasTable('tl_buyer_kyc_documents')) {
            Schema::create('tl_buyer_kyc_documents', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('file_id'); // Reference to tl_uploaded_files
                $table->string('document_type')->nullable(); // e.g., 'business_license', 'id_card', 'passport'
                $table->string('status')->default('pending'); // pending, approved, rejected
                $table->text('notes')->nullable();
                $table->timestamps();
                
//                $table->foreign('user_id')->references('id')->on('tl_users')->onDelete('cascade');
//                $table->foreign('file_id')->references('id')->on('tl_uploaded_files')->onDelete('cascade');
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
        if (Schema::hasTable('tl_buyer_kyc_documents')) {
            Schema::dropIfExists('tl_buyer_kyc_documents');
        }
    }
};
