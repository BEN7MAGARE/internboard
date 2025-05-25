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
        Schema::table('students', function (Blueprint $table) {
            $table->string('id_no')->nullable()->after('id');
            $table->string('admision_number')->nullable()->after('id_no');
            $table->string('course_level')->nullable()->after('course_id');
            $table->boolean('sponsored')->default(false)->after('gender');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('id_no');
            $table->dropColumn('admision_number');
            $table->dropColumn('course_level');
            $table->dropColumn('sponsored');
        });
    }
};
