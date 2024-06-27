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
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('copy_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->date('borrow_date')->default(now());
            $table->date('expected_return_date');
            $table->date('return_date')->nullable();
            $table->foreignId('status_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->default(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrows');
    }
};
