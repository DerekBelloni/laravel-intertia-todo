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
        Schema::create('archived_tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('task_id');
            $table->integer('task_type_id');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('task_title')->nullable();
            $table->string('task_body')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archived_tasks');
    }
};
