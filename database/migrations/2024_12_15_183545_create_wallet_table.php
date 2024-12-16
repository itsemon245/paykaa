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
        Schema::create('wallet', function (Blueprint $table) {

            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('transaction_id')->nullable();
            $table->string('transaction_type')->comment('deposit|withdraw|transfer_in|transfer_out|earn|service_charge');
            $table->string('type')->comment('debit|credit');
            $table->decimal('amount', 12, 2)->default(0);
            $table->string('currency')->default('bdt');
            $table->string('note')->nullable();
            $table->string('method')->nullable();
            $table->string('payment_number')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('failed_at')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            $table->index('uuid');
            $table->index('type');
            $table->index('transaction_type');
            $table->index('created_at');
            $table->index('approved_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
