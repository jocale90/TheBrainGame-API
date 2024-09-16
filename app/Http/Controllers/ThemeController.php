<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;

class ThemeController extends Controller
{
    public function getImages($theme_id)
    {
        // Buscar la categoría en la base de datos
        $theme = Theme::where('id_in_s3', $theme_id)->first();

        if (!$theme) {
            return response()->json(['error' => 'Theme not found'], 404);
        }

        // Obtener las imágenes desde la carpeta de S3 correspondiente
        $files = Storage::disk('s3')->files("themes/{$theme->id_in_s3}");

        // Generar las URLs de las imágenes
        $imageUrls = array_map(function ($file) {
            return Storage::disk('s3')->url($file);
        }, $files);

        return response()->json([
            'theme' => $theme->name,
            'images' => $imageUrls,
            'backgroundImage' => $theme->background_image
        ]);
    }
}
