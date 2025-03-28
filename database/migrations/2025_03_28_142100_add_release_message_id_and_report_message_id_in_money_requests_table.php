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
        Schema::table('money_requests', function (Blueprint $table) {
            $table->foreignId('release_message_id')->nullable()->constrained('messages')->nullOnDelete();
            $table->foreignId('report_message_id')->nullable()->constrained('messages')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('money_requests', function (Blueprint $table) {
            $table->dropForeign(['release_message_id']);
            $table->dropForeign(['report_message_id']);
            $table->dropColumn('release_message_id');
            $table->dropColumn('report_message_id');
        });
    }
};
