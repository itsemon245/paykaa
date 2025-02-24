<?php

use App\Enum\Status;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        User::with('kyc')->get()->each(function (User $user) {
            $user->update([
                'kyc_status' => $user->kyc ? DB::raw('kyc_status') : Status::NOT_VERIFIED->value,
                'avatar' => !$user->avatar ? 'assets/images/user.png' : $user->avatar,
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
