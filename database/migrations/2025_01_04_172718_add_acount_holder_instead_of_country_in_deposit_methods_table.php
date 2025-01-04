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
            $table->string('account_holder')->nullable()->after('category');
            $table->dropColumn('country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deposit_methods', function (Blueprint $table) {
            $table->string('country')->nullable()->after('category');
            $table->dropColumn('account_holder');
        });
    }
};
