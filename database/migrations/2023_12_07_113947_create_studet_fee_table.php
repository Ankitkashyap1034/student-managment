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
        Schema::create('student_fee', function (Blueprint $table) {
            $table->id();
            $table->string('mobile_no')->nullable();
            $table->unsignedBigInteger('student_id');
            $table->string('fee_amount')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('remark')->nullable();

            $table->foreign('student_id')->references('id')->on('student');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_fee');
    }
};
