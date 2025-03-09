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
        try {
            Schema::table('users', function (Blueprint $table) {
                $table->dropUnique(['phone']);
            });
        } catch (\Throwable $th) {
        }
        try {
            Schema::table('phone_histories', function (Blueprint $table) {
                $table->dropUnique(['phone']);
            });
        } catch (\Throwable $th) {
        }
    }
};
