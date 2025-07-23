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
        Schema::table('corporates', function (Blueprint $table) {
            $table->string('description')->nullable()->after('address');
            $table->string('website')->nullable()->after('description');
            $table->string('nature_of_business')->nullable()->after('website');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('corporates', function (Blueprint $table) {
            $table->dropColumn('website');
            $table->dropColumn('description');
            $table->dropColumn('nature_of_business');
        });
    }
};
