<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function image($width, $height = null)
    {
        // Get the image from the filesystem
        $image = Storage::disk('local')->get('deadpool.jpg');

        // Make a new image instance and resize
        $image = Image::make($image)->resize($width, $height ? $height : $width);

        if (request()->has('greyscale')) {
            $image->greyscale();
        }

        if (request()->has('blur')) {
            $image->blur(20);
        }

        if (request()->has('pixelate')) {
            $image->pixelate(5);
        }

        return $image->response('png');
    }
}
