<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tl_multivendor_irec_project_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('image_path');
            $table->enum('image_type', ['main', 'gallery'])->default('gallery');
            $table->string('alt_text')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            // Index with custom name
            $table->index('project_id', 'irec_images_project_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tl_multivendor_irec_project_images');
    }
};
