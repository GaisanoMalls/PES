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
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->bigInteger('department_id')->default(0);
            $table->string('employee_id')->default('No ID');
            $table->string('branch_name')->default('DAVAO');
            $table->string('first_name')->default('No fname');
            $table->string('last_name')->default('No lname');
            $table->string('contact_no')->default('No contact number');
            $table->string('date_hired')->default('No date hired');
            $table->string('position')->default('No position');
            $table->string('employment_status')->default('No e-status');
            $table->tinyInteger('is_active')->default(1); // Default value set to 1 (active)
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
