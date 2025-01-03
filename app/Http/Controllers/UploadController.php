<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;

class UploadController extends Controller
{
    private function getPath(string $folder): string {
        return storage_path('app/public/temp/'.$folder);
    }
    public function store(Request $request) {
        $folder = Uuid::uuid7()->toString() ?? uniqid('temp-');
        $path = $this->getPath($folder);
        mkdir($path, recursive: true);
        file_put_contents($path.'/file.part', '');
        return $folder;
    }

    public function update(Request $request) {
        $tempFolder = $this->getPath($request->query('patch'));
        $path = $tempFolder.'/file.part';

        File::append($path, $request->getContent());

        // The code below should probably be going into a POST controller method
        // As the documentation recommends us to actually move the file once it's done.
        if (filesize($path) == $request->header('Upload-Length')) {
            $name = $request->header('Upload-Name');
            $arr = explode('.', $name);
            $ext = array_pop($arr);
            $name = implode('-', $arr)."-".now()->toDateTimeString('microseconds');
            $filename = $request->query('patch').".".$ext;
            $location = storage_path("app/public/temp/completed");
            if (!File::exists($location)) {
                mkdir($location, recursive: true);
            }
            $destination = $location."/".$filename;
            // Delete the old file
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $ok = File::move($path, $destination);
            if ($ok) {
                File::deleteDirectory($tempFolder);
            }
        }
        return response()->json(['uploaded' => true]);
    }
}
