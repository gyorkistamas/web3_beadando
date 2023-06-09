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
        Schema::create('poll_options', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('poll_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->integer('number_of_answers')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poll_questions');
    }
};
