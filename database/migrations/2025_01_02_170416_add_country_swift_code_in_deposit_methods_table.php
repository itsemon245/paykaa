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
            $table->string('country')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('branch')->nullable();
            $table->string('routing_number')->nullable();

            //Changes
            $table->string('mode')->nullable()->change();
            $table->string('number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deposit_methods', function (Blueprint $table) {
            $table->dropColumn('country');
            $table->dropColumn('swift_code');
            $table->dropColumn('branch');
            $table->dropColumn('routing_number');
        });
    }
};
