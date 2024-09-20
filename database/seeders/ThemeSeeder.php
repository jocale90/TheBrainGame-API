<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('themes')->insert([
            [
                'name' => 'Vida Marina',
                'id_in_s3' => 'marine',
                'background_image' => 'https://general-porpuse.s3.amazonaws.com/themes/marine/background.png',
                'card_background' => 'https://general-porpuse.s3.amazonaws.com/themes/marine/backgroundcard.png', 
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Perritos',
                'id_in_s3' => 'dogs',
                'background_image' => 'https://general-porpuse.s3.amazonaws.com/themes/dogs/background.png',
                'card_background' => 'https://general-porpuse.s3.amazonaws.com/themes/dogs/backgroundcard.png', 
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
