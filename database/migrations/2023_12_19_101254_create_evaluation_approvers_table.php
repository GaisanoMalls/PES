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
        Schema::create('evaluation_approvers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('approver_id');
            $table->bigInteger('employee_id');
            $table->bigInteger('department_configuration_id');
            $table->integer('approver_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_approvers');
    }
};
