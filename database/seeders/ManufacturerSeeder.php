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
        Manufacturer::create([ //1
            'name' => 'OgnioChron',
        ]);

        Manufacturer::create([ //2
            'name' => 'Calisia Vulcan',
        ]);

        Manufacturer::create([ //3
            'name' => 'Flir',
        ]);

        Manufacturer::create([ //4
            'name' => 'HONEYWELL',
        ]);

        Manufacturer::create([ //5
            'name' => 'BIOMASK',
        ]);

        Manufacturer::create([ //6
            'name' => 'OPTI-PRO',
        ]);

        Manufacturer::create([ //7
            'name' => 'Aeris',
        ]);
    }
}
