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
        Schema::create('evaluators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bu_id');
            $table->unsignedBigInteger('department_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('contact_no');
            $table->string('position');
            $table->tinyInteger('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluators');
    }
};
