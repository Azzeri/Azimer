<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Database seeder
 *
 * @author Mariusz Waloszczyk
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @author Mariusz Waloszczyk
     */
    public function run(): void
    {
        $this->call([
            RoleResourceSeeder::class,
            UserSeeder::class,
            FireBrigadeUnitSeeder::class,
            ManufacturerSeeder::class,
            EqItemCategorySeeder::class,
            VehicleSeeder::class,
            EqItemTemplateSeeder::class,
            EqServiceTemplateSeeder::class,
            EqItemSeeder::class,
        ]);
    }
}
