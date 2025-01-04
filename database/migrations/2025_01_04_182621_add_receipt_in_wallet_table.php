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
        Schema::table('wallet', function (Blueprint $table) {
            $table->string('receipt')->nullable();
            $table->foreignId('deposit_method_id')->nullable()->constrained('deposit_methods')->nullOnDelete();
            $table->foreignId('withdraw_method_id')->nullable()->constrained('withdraw_methods')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wallet', function (Blueprint $table) {
            $table->dropColumn('receipt');
            $table->dropForeign('wallet_deposit_method_id_foreign');
            $table->dropForeign('wallet_withdraw_method_id_foreign');
            $table->dropColumn('deposit_method_id');
            $table->dropColumn('withdrawal_method_id');
        });
    }
};
