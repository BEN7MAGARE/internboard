<?php

use App\Models\College;
use App\Models\County;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(College::class)->nullable();
            $table->foreignIdFor(County::class)->nullable();
            $table->foreignIdFor(Course::class)->nullable();
            $table->string('reg_number')->nullable();
            $table->string('year_of_study')->nullable();
            $table->string('kin_name')->nullable();
            $table->string('kin_phone')->nullable();
            $table->string('kin_email')->nullable();
            $table->string('kin_relationship')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
