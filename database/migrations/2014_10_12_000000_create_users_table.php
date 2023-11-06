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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('role_id');
            $table->string('email');
            $table->string('password');
            $table->tinyInteger('is_active');
            $table->rememberToken();
            $table->timestamps();

            // Foreign key for approvers
            $table->foreign('person_id', 'users_person_id_approvers')
                ->references('id')
                ->on('approvers');

            // Foreign key for evaluators
            $table->foreign('person_id', 'users_person_id_evaluators')
                ->references('id')
                ->on('evaluators');

            // Foreign key for human resource
            $table->foreign('person_id', 'users_person_id_human_resources')
                ->references('id')
                ->on('human_resources');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
