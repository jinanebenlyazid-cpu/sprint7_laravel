<?php

namespace Database\Seeders;
use App\Models\Voyage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoyageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Voyage::insert([
            [
            'code_voyage'=>'ONCF001',
            'heureDepart'=>'08:00:00',
            'villeDepart'=>'Rabat',
            'heureDarrivee'=>'09:30:00',
            'villeDarrivee'=>'Casablanca',
            'prixVoyage'=>80
            ],
            [
            'code_voyage'=>'ONCF002',
            'heureDepart'=>'10:00:00',
            'villeDepart'=>'Casablanca',
            'heureDarrivee'=>'12:00:00',
            'villeDarrivee'=>'Marrakech',
            'prixVoyage'=>120
            ]
        ]);
    }
}
