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
            'fire_brigade_unit_id' => 1,
        ]);

        Vehicle::create([
            'number' => 2,
            'name' => 'PGAZ',
            'fire_brigade_unit_id' => 1,
        ]);

        Vehicle::create([
            'number' => 3,
            'name' => 'MAN',
            'fire_brigade_unit_id' => 1,
        ]);
    }
}
