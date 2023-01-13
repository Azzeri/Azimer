<?php

namespace Database\Seeders;

use App\Models\EqServiceTemplate;
use Illuminate\Database\Seeder;

/**
 * @author Mariusz Waloszczyk
 */
class EqServiceTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @author Mariusz Waloszczyk
     */
    public function run(): void
    {
        EqServiceTemplate::create([
            'name' => 'Wymiana baterii',
            'eq_item_category_id' => 3,
            'manufacturer_id' => 1,
            'interval' => 14,
        ]);

        EqServiceTemplate::create([
            'name' => 'Konserwacja ogólna',
            'eq_item_category_id' => 10,
            'manufacturer_id' => 3,
            'interval' => 10,
        ]);

        EqServiceTemplate::create([
            'name' => 'Konserwacja ogólna',
            'eq_item_category_id' => 11,
            'manufacturer_id' => 3,
            'interval' => 14,
        ]);
    }
}
