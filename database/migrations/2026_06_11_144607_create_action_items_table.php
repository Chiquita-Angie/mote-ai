<?php

use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;

return new class extends Migration

{

    public function up(): void

    {

        Schema::create('action_items', function (Blueprint $table) {

            $table->id();

            $table->foreignId('meeting_id')->constrained()->onDelete('cascade');

            $table->string('task');

            $table->string('pic')->nullable();

            $table->date('deadline')->nullable();

            $table->string('status')->default('Pending');

            $table->timestamps();

        });

    }

    public function down(): void

    {

        Schema::dropIfExists('action_items');

    }

};