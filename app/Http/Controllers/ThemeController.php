<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ThemeController;
use App\Models\Theme;

class ThemeController extends Controller
{
    public function getImages($theme_id)
    {
        // Buscar la categoría en la base de datos usando el 'id_in_s3'
        $theme = Theme::where('id_in_s3', $theme_id)->first();
    
        if (!$theme) {
            return response()->json(['error' => 'Theme not found'], 404);
        }
    
        // Obtener las imágenes desde la carpeta de S3 correspondiente al theme_id
        $files = Storage::disk('s3')->files("themes/{$theme->id_in_s3}");
    
        // Filtrar la imagen de fondo para no incluirla en las imágenes
        $imageUrls = array_filter($files, function ($file) use ($theme) {
            return !str_ends_with($file, 'background.png');
        });
    
        // Generar las URLs de las imágenes
        $imageUrls = array_map(function ($file) {
            return Storage::disk('s3')->url($file);
        }, $imageUrls);
    
        return response()->json([
            'theme' => $theme->name,
            'images' => $imageUrls,
            'backgroundImage' => $theme->background_image
        ]);
    }

    public function getAllThemes()
    {

        $themes = Theme::all(['id_in_s3', 'name', 'background_image']);

        $response = $themes->map(function ($theme) {
            return [
                'id' => $theme->id_in_s3,
                'name' => $theme->name,
                'backgroundImage' => $theme->background_image
            ];
        });

        return response()->json($response);
    }
    
    
}
