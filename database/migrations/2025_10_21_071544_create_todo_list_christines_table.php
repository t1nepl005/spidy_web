<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('todo_list_christines', function (Blueprint $table) {
            $table->id();
            // foreign id
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('task');
            $table->text('description')->nullable();
            // enum
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todo_list_christines');
    }
};
