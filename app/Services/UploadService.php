<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }

    public static function upload(UploadedFile $file, $folder, $disk = "public") 
    {
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        $extension = $file->getClientOriginalExtension();

        $filename = $filename . "-" . time() . "." . $extension;
        $file->storeAs($folder, $filename, $disk);
        return $folder . "/" . $filename;
    }

    public static function delete($path, $disk = "public") 
    {
        if(!Storage::disk($disk)->exists($path->image))
        {
            return false;
        }

        return Storage::disk($disk)->delete($path->image);
    }

    public static function url($path, $disk = "public")
    {
        return Storage::disk($disk)->url($path);
    }
}
