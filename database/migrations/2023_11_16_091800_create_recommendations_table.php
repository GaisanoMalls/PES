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
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('evaluation_id');
            $table->bigInteger('employee_id');
            $table->double('current_salary');
            $table->string('recommended_position');
            $table->string('level');
            $table->string('employment_status');
            $table->double('recommended_salary');
            $table->double('percentage_increase');
            $table->string('remarks')->nullable();
            $table->timestamp('effectivity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommendations');
    }
};
