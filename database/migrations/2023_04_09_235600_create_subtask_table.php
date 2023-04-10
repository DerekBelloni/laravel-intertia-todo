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
        Schema::create('subtask', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_task_id');
            $table->string('subtask_type');
            $table->string('subtask_body');
            $table->boolean('subtask_completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subtask');
    }
};
