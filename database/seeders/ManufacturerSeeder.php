<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use Illuminate\Database\Seeder;

/**
 * @author Piotr Nagórny
 */
class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @author Piotr Nagórny
     */
    public function run(): void
    {
        Manufacturer::create([
            'name' => 'OgnioChron',
        ]);

        Manufacturer::create([
            'name' => 'Calisia Vulcan',
        ]);

        Manufacturer::create([
            'name' => 'Flir',
        ]);

        Manufacturer::create([
            'name' => 'HONEYWELL',
        ]);

        Manufacturer::create([
            'name' => 'BIOMASK',
        ]);

        Manufacturer::create([
            'name' => 'OPTI-PRO',
        ]);

        Manufacturer::create([
            'name' => 'Aeris',
        ]);
    }
}
