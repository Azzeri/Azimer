<?php

namespace Database\Seeders;

use App\Models\FireBrigadeUnit;
use Illuminate\Database\Seeder;

/**
 * @author Mariusz Waloszczyk
 */
class FireBrigadeUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @author Mariusz Waloszczyk
     */
    public function run(): void
    {
        FireBrigadeUnit::create([
            'name' => 'Komenda główna Wrocław',
            'addr_street' => 'Marii Skłodowskiej',
            'addr_number' => '15',
            'addr_postcode' => '55-100',
            'addr_locality' => 'Wrocław',
        ]);

        FireBrigadeUnit::create([
            'name' => 'OSP Opole',
            'addr_street' => 'Jana Długosza',
            'addr_number' => '48',
            'addr_postcode' => '53-258',
            'addr_locality' => 'Opole',
            'superior_unit_id' => 1,
        ]);

        FireBrigadeUnit::create([
            'name' => 'OSP Kluczbork',
            'addr_street' => 'Stefana Żeromskiego',
            'addr_number' => '69',
            'addr_postcode' => '48-300',
            'addr_locality' => 'Kluczbork',
            'superior_unit_id' => 1,
        ]);
    }
}
