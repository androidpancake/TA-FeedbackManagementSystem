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
        Schema::create('response', function (Blueprint $table) {
            $table->id();
            $table->integer('rating');
            $table->string('comment');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('survey_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('response');
    }
};
