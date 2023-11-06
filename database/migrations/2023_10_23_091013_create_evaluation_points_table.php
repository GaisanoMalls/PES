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
        Schema::create('evaluation_points', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('evaluation_id');
            $table->bigInteger('evaluator_id');
            $table->bigInteger('employee_id');
            $table->bigInteger('evaluation_template_id');
            $table->bigInteger('part_id');
            $table->bigInteger('factor_id');
            $table->bigInteger('rating_scale_id');
            $table->bigInteger('factor_rating_scale_id');
            $table->double('points');
            $table->text('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_points');
    }
};
