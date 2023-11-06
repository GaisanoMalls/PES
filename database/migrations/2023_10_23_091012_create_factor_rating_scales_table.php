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
        Schema::create('factor_rating_scales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('evaluation_template_id');
            $table->bigInteger('part_id');
            $table->bigInteger('factor_id');
            $table->bigInteger('rating_scale_id');
            $table->double('equivalent_points');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factor_rating_scales');
    }
};
