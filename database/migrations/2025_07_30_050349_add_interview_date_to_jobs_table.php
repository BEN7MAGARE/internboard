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
        Schema::table('jobs', function (Blueprint $table) {
            $table->date('interview_date')->nullable()->after('application_end_date');
            $table->string('interview_method')->nullable()->after('interview_date');
            $table->string('interview_place')->nullable()->after('interview_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('interview_date');
            $table->dropColumn('interview_method');
            $table->dropColumn('interview_place');
        });
    }
};
