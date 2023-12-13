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
        Schema::create('notification_employees', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('notifiable_id');
            $table->bigInteger('person_id');
            $table->text('notif_title');
            $table->text('notif_desc');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            // Define foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
