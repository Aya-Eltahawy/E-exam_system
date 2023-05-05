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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->text('correct_answer');
            $table->integer('difficulty_level');
            $table->string('question_type');
            $table->boolean('is_training');
            $table->unsignedBigInteger('chapter_id');
            $table->unsignedBigInteger('subject_id');

            $table->timestamps();

            $table->foreign('chapter_id')->references('id')->on('chapters');
            $table->foreign('subject_id')->references('id')->on('subjects');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
