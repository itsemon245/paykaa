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
        Schema::table('deposit_methods', function (Blueprint $table) {
            $table->string('number')->nullable()->change();
            $table->json('additional_fields')->after('secrets')->nullable();
            $table->integer('charge')->default(0);
            $table->boolean('is_fixed_amount')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deposit_methods', function (Blueprint $table) {
            $table->dropColumn('additional_fields');
            $table->dropColumn('charge');
            $table->dropColumn('is_fixed_amount');
        });
    }
};
