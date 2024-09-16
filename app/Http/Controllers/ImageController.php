<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function listImages()
    {
        // Obtiene la lista de imágenes del bucket
        $files = Storage::disk('s3')->files('themes/marine'); // Ajusta el path si es necesario

        // Genera las URLs de las imágenes
        $imageUrls = array_map(function ($file) {
            return Storage::disk('s3')->url($file);
        }, $files);

        return response()->json($imageUrls);
    }
}

