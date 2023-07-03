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
        Schema::table('work_checklists', function (Blueprint $table) {
            $table->string('priority')->nullable();
            $table->string('projects')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('work_checklsits', function (Blueprint $table) {
            $table->dropColumn('priority');
            $table->dropColumn('projects');
        });
    }
};
