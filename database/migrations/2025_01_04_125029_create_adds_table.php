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
        Schema::create('adds', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('type');
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('add_method_id')->constrained('add_methods')->onDelete('cascade');
            $table->integer('amount');
            $table->integer('rate');
            $table->integer('limit_max')->nullable();
            $table->integer('limit_min')->nullable();
            $table->string('contact')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adds');
    }
};