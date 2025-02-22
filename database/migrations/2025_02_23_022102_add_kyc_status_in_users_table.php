<?php

use App\Enum\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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
        Schema::table('users', function (Blueprint $table) {
            $table->string('kyc_status')->default(Status::PENDING->value);
        });
        User::whereHas('kyc', function (Builder $kycQuery) {
            $kycQuery->whereNotNull('approved_at');
        })->update(['kyc_status' => Status::APPROVED->value]);
        User::whereHas('kyc', function (Builder $kycQuery) {
            $kycQuery->whereNotNull('rejected_at');
        })->update(['kyc_status' => Status::REJECTED->value]);
        User::whereHas('kyc', function (Builder $kycQuery) {
            $kycQuery->whereNull('approved_at')->whereNull('rejected_at');
        })->update(['kyc_status' => Status::PENDING->value]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('kyc_status');
        });
    }
};
