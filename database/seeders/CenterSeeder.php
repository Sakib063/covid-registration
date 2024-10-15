<?php

namespace Database\Seeders;

use App\Models\Center;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hospitals=[
            'Dhaka Medical College',
            'Salimullah Medical College',
            'Barishal Medical College',
            'Mymensing Medical College',
            'Cox Bazar Medical College',
            'Chandpur Medical College',
            'Khulna Medical College',
            'Sylhet Medical College',
            'Rajshahi Medical College',
            'Delta Medical College',
        ];

        foreach($hospitals as $hospital){
            Center::create([
                'name' => $hospital,
                'limit'=>Factory::create()->numberBetween(1,5),
            ]);
        }
    }
}
