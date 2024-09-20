<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         
         $users = [
            [
                'name' => 'Jose Pernia',
                'email' => 'joseapc90@gmail.com',
                'password' => Hash::make('password'), // Usar Hash::make para encriptar las contraseñas
            ],
            [
                'name' => 'Miguel',
                'email' => 'miguel@game.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Juan',
                'email' => 'juan@game.com',
                'password' => Hash::make('password'),
            ],
        ];

        // Insertar los usuarios en la base de datos
        foreach ($users as $userData) {
            // Crear el usuario en la base de datos
            $user = User::create($userData);

            // Verificar si el usuario fue creado antes de intentar generar un token
            if ($user) {
                // Generar el token de Sanctum
                $token = $user->createToken('API Token')->plainTextToken;

                // Opcionalmente, imprimir el token en la consola para poder copiarlo
                $this->command->info("Token for {$user->name}: {$token}");
            }
        }
    }
}
