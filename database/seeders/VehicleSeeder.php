<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @author Piotr Nagórny
     */
    public function run(): void
    {
        Vehicle::create([
            'number' => 1,
            'name' => 'STAR',
        ]);

        Vehicle::create([
            'number' => 2,
            'name' => 'PGAZ',
        ]);

        Vehicle::create([
            'number' => 3,
            'name' => 'MAN',
        ]);
    }
}
