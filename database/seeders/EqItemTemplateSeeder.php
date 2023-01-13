<?php

namespace Database\Seeders;

use App\Models\EqItemTemplate;
use Illuminate\Database\Seeder;

/**
 * @author Mariusz Waloszczyk
 */
class EqItemTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @author Mariusz Waloszczyk
     */
    public function run(): void
    {
        EqItemTemplate::create([
            'name' => 'Latarka',
            'eq_item_category_id' => 3,
            'manufacturer_id' => 1,
            'has_construction_number' => 1,
            'has_identification_number' => 1,
            'has_date_production' => 1
        ]);

        EqItemTemplate::create([
            'name' => 'Butla kompozytowa',
            'eq_item_category_id' => 10,
            'manufacturer_id' => 3,
            'has_inventory_number' => 1,
            'has_identification_number' => 1,
            'has_date_production' => 1,
            'has_date_expiry' => 1,
            'has_date_legalisation' => 1,
            'has_date_legalisation_due' => 1
        ]);

        EqItemTemplate::create([
            'name' => 'Butla stalowa',
            'eq_item_category_id' => 11,
            'manufacturer_id' => 3,
            'has_inventory_number' => 1,
            'has_identification_number' => 1,
            'has_date_production' => 1,
            'has_date_expiry' => 1,
            'has_date_legalisation' => 1,
            'has_date_legalisation_due' => 1
        ]);
    }
}
