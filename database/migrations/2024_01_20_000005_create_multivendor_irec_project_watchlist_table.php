<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tl_multivendor_irec_project_watchlist', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('buyer_id');
            $table->timestamps();
            
            // Indexes with custom names
            $table->index('project_id', 'irec_watch_project_index');
            $table->index('buyer_id', 'irec_watch_buyer_index');
            $table->unique(['project_id', 'buyer_id'], 'irec_watch_unique_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tl_multivendor_irec_project_watchlist');
    }
};
