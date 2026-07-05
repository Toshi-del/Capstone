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
        Schema::table('annual_physical_examinations', function (Blueprint $table) {
            // Drop the existing foreign key constraint if it exists
            $table->dropForeign(['patient_id']);
            
            // Add the correct foreign key constraint to reference patients table
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('annual_physical_examinations', function (Blueprint $table) {
            // Drop the correct foreign key constraint
            $table->dropForeign(['patient_id']);
            
            // Add back the incorrect foreign key constraint (for rollback)
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('set null');
        });
    }
};
