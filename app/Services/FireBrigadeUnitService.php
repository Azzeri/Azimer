<?php

namespace App\Services;

use App\Helpers\DataTableRow;
use App\Http\Resources\DateTableRowResource;
use App\Http\Resources\FireBrigadeUnitResource;
use App\Models\FireBrigadeUnit;
use Illuminate\Support\Facades\DB;

/**
 * Fire brigade units services class
 *
 * @author Mariusz Waloszczyk
 */
class FireBrigadeUnitService
{
    /**
     * Returns units list for index method
     *
     * @author Mariusz Waloszczyk
     */
    public function getFireBrigadeUnitsQuery()
    {
        $dataTableService = new DataTableService(
            [
                new DataTableRow('id', 'ID', searchable: false),
                new DataTableRow('name', 'name'),
                new DataTableRow('addr_locality', 'locality'),
                new DataTableRow('superior_unit_id', 'superior unit', searchable: false),
                new DataTableRow('actions', 'actions', searchable: false, sortable: false),
            ]
        );

        $query = $dataTableService->prepareQuery(
            FireBrigadeUnit::class,
            [
                'superiorFireBrigadeUnit',
            ],
        );

        $query = $dataTableService->getResults($query);

        return FireBrigadeUnitResource::collection($query)
            ->additional([
                'columns' => DateTableRowResource::collection(
                    $dataTableService->getFields()
                ),
            ]);
    }

    /**
     * Detaches all related models
     *
     * @author Mariusz Waloszczyk
     */
    public function detachRelationships(
        FireBrigadeUnit $fireBrigadeUnit
    ): void {
        DB::table('users')
            ->where('fire_brigade_unit_id', $fireBrigadeUnit->id)
            ->update(['fire_brigade_unit_id' => null]);

        DB::table('fire_brigade_units')
            ->where('superior_unit_id', $fireBrigadeUnit->id)
            ->update(['superior_unit_id' => null]);
    }

    /**
     * Returns random fire brigade unit or creates one
     * if none exists
     *
     * @author Mariusz Waloszczyk
     */
    public static function getRandomFireBrigadeUnit(): FireBrigadeUnit
    {
        $unit = FireBrigadeUnit::inRandomOrder()->first();

        if (is_null($unit)) {
            return FireBrigadeUnit::factory()
                ->create();
        }

        return $unit;
    }
}
