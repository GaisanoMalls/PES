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
        Schema::create('evaluation_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('evaluator_id');
            $table->string('employee_id');
            $table->bigInteger('department_id');
            $table->bigInteger('branch_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_permissions');
    }
};
