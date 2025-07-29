<?php

use App\Models\Application;
use App\Models\User;
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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no')->nullable();
            $table->foreignIdFor(Application::class)->nullable();
            $table->foreignIdFor(User::class)->nullable();
            $table->string('terms')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('rate_amount')->nullable();
            $table->string('rate_type')->nullable();
            $table->string('signed_at')->nullable();
            $table->string('files')->nullable();
            $table->string('status')->nullable();
            $table->string('accepted')->nullable();
            $table->string('acceptance_note')->nullable();
            $table->string('accepted_at')->nullable();
            $table->string('rejected')->nullable();
            $table->string('rejection_note')->nullable();
            $table->string('rejected_at')->nullable();
            $table->string('progress')->nullable();
            $table->string('progress_note')->nullable();
            $table->string('terminated')->nullable();
            $table->string('termination_note')->nullable();
            $table->string('terminated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
