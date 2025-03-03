<?php

use App\Models\Chat;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schedule;

//scheduler
// Schedule::command('typing:off')->everyFiveSeconds();

//command registry
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->hourly();

Artisan::command('typing:off', function () {
    $this->info('Turning off typing...');
    $chats = Chat::whereNot('typing', '[]')->update(['typing' => '[]']);
})->everyTenSeconds();

Artisan::command('delete:temp {days?}', function ($days = 30) {
    $this->info("Deleting temp files older than $days days...");

    $path = storage_path('app/public/temp');
    $files = File::allFiles($path);
    $now = Carbon::now();
    $deletedCount = 0;

    foreach ($files as $file) {
        $this->info("File: {$file->getPath()}");
        // Convert timestamp to Carbon instance
        $lastModified = Carbon::createFromTimestamp($file->getMTime());
        if (round($lastModified->diffInDays($now)) >= $days) {
            File::delete($file->getPathname());
            $deletedCount++;
        }
    }
    $this->info("Deleted $deletedCount files.");
})->monthly();
