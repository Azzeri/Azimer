<?php

namespace Database\Seeders;

use App\Models\EqItemCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * @author Piotr Nagórny
 */
class EqItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eq_item_categories')->insert([
            'name' => 'Hełmy',
        ]);

        DB::table('eq_item_categories')->insert([
            'name' => 'Kamery Termowizyjne',
        ]);

        DB::table('eq_item_categories')->insert([ //3
            'name' => 'Latarki',
        ]);

        DB::table('eq_item_categories')->insert([
            'name' => 'Gaśnice',
        ]);

        DB::table('eq_item_categories')->insert([
            'name' => 'Gaśnice proszkowe',
            'parent_category_id' => 4,
        ]);

        DB::table('eq_item_categories')->insert([
            'name' => 'Gaśnice pianowe',
            'parent_category_id' => 4,
        ]);

        DB::table('eq_item_categories')->insert([
            'name' => 'Gaśnice śniegowe',
            'parent_category_id' => 4,
        ]);

        DB::table('eq_item_categories')->insert([
            'name' => 'Gaśnice wodne',
            'parent_category_id' => 4,
        ]);

        EqItemCategory::create([ //9
            'name' => 'Butle',
            'is_fillable' => true,
        ]);

        EqItemCategory::create([ //10
            'name' => 'Butle kompozytowe',
            'parent_category_id' => 9,
            'is_fillable' => true,
        ]);

        EqItemCategory::create([ //11
            'name' => 'Butle stalowe',
            'parent_category_id' => 9,
            'is_fillable' => true,
        ]);

        EqItemCategory::create([ //12
            'name' => 'Maski',
            'is_fillable' => true,
        ]);

        EqItemCategory::create([ //13
            'name' => 'Aparaty powietrzne',
            'is_fillable' => true,
        ]);
    }
}
