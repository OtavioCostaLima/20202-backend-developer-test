<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'description' => 'água',
            'point' => 4,
        ]);

        DB::table('items')->insert([
            'description' => 'comida',
            'point' => 3,
        ]);
        
        DB::table('items')->insert([
            'description' => 'medicação',
            'point' => 2,
        ]);

        DB::table('items')->insert([
            'description' => 'munição',
            'point' => 1,
        ]);
    }
}
