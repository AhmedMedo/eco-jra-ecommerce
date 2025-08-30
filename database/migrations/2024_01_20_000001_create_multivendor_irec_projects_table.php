<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tl_multivendor_irec_projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_id')->unique();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->string('project_name');
            $table->text('description')->nullable();
            $table->enum('energy_type', ['solar', 'wind', 'hydro', 'bio']);
            $table->string('country');
            $table->year('vintage_year');
            $table->decimal('capacity_mwh', 10, 2);
            $table->decimal('available_quantity_mwh', 10, 2);
            $table->integer('total_irecs');
            $table->decimal('price_per_mwh', 10, 2);
            $table->boolean('vat_included')->default(true);
            $table->string('project_image')->nullable();
            $table->string('project_link')->nullable();
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
            $table->decimal('coordinates_lat', 10, 8)->nullable();
            $table->decimal('coordinates_lng', 11, 8)->nullable();
            
            // Address fields
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('postal_code')->nullable();
            
            // Certification fields
            $table->string('evident_id')->nullable();
            $table->date('issuance_date')->nullable();
            $table->date('expiry_date')->nullable();
            
            // Project details
            $table->string('technology')->nullable();
            $table->decimal('project_capacity', 15, 2)->nullable();
            $table->enum('capacity_unit', ['kWh', 'MWh', 'GWh'])->default('MWh');
            
            $table->timestamps();
            
            // Indexes with custom names to avoid length issues
            $table->index(['energy_type', 'country', 'vintage_year', 'status'], 'irec_projects_main_index');
            $table->index(['evident_id', 'issuance_date', 'expiry_date'], 'irec_projects_cert_index');
            $table->index('seller_id', 'irec_projects_seller_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tl_multivendor_irec_projects');
    }
};
