<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->date('meeting_date')->nullable();
            $table->string('location')->nullable();
            $table->text('participants')->nullable();
            $table->longText('raw_notes');
            $table->longText('ai_summary')->nullable();
            $table->longText('decisions')->nullable();
            $table->longText('follow_up_message')->nullable();
            $table->integer('health_score')->nullable();
            $table->string('status')->default('Draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
