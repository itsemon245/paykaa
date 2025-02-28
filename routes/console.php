<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('schedule:run', function () {
    $this->info('Running scheduled commands...');
    Artisan::call('delete:temp');
})->purpose('Run scheduled commands')->daily();

Artisan::command('delete:temp {days?}', function ($days = 0) {
    $this->info("Deleting temp files older than $days days...");

    $path = storage_path('app/public/temp');
    $files = File::allFiles($path);
    $now = Carbon::now();
    $deletedCount = 0;

    foreach ($files as $file) {
        $this->info("File: {$file->getPath()}");
        // Convert timestamp to Carbon instance
        $lastModified = Carbon::createFromTimestamp($file->getMTime());
        dd($lastModified->diffInDays($now));

        if ($now->diffInDays($lastModified) >= $days) {
            File::delete($file->getPathname());
            $deletedCount++;
        }
    }

    $this->info("Deleted $deletedCount files.");
})->purpose('Delete temp files')->monthly();
