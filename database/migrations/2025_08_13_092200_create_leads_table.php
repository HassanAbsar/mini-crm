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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone');
        $table->enum('status', ['new', 'contacted', 'closed'])->default('new');
        $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
        $table->text('notes')->nullable();
        $table->softDeletes();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
