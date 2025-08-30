<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tl_multivendor_irec_project_certifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->enum('certification_type', ['IREC', 'GCC', 'EU', 'other']);
            $table->string('certification_number')->nullable();
            $table->date('issuance_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('verified_by')->nullable();
            $table->timestamps();
            
            // Index with custom name
            $table->index('project_id', 'irec_cert_project_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tl_multivendor_irec_project_certifications');
    }
};
