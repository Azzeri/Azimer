<?php

namespace Database\Seeders;

use App\Models\EqItem;
use Illuminate\Database\Seeder;

/**
 * @author Mariusz Waloszczyk
 */
class EqItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @author Mariusz Waloszczyk
     */
    public function run(): void
    {
        EqItem::create([
            'code' => 'I000000',
            'eq_item_template_id' => 1,
            'fire_brigade_unit_id' => 1,
            'construction_number' => '657123',
            'identification_number' => '983124',
            'date_production' => '2020-10-12',
        ]);

        EqItem::create([
            'code' => 'I000001',
            'eq_item_template_id' => 2,
            'fire_brigade_unit_id' => 1,
            'inventory_number' => '834678',
            'identification_number' => '245682',
            'date_production' => '2021-03-15',
            'date_expiry' => '2024-03-15',
            'date_legalisation' => '2021-03-18',
            'date_legalisation_due' => '2024-03-15',
        ]);

        EqItem::create([
            'code' => 'I000002',
            'eq_item_template_id' => 3,
            'fire_brigade_unit_id' => 1,
            'inventory_number' => '765340',
            'identification_number' => '098345',
            'date_production' => '2021-04-25',
            'date_expiry' => '2024-04-25',
            'date_legalisation' => '2021-04-18',
            'date_legalisation_due' => '2024-04-25',
        ]);
    }
}
