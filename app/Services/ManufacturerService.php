<?php

namespace App\Services;

use App\Helpers\DataTableRow;
use App\Http\Requests\Manufacturer\ManufacturerRequest;
use App\Http\Resources\DateTableRowResource;
use App\Http\Resources\ManufacturerResource;
use App\Models\Manufacturer;

/**
 * Class for roles operations
 *
 * @author Piotr Nagórny
 */
class ManufacturerService
{
    /**
     * Returns manufacturers list for index method
     *
     * @author Mariusz Waloszczyk
     */
    public function getManufacturersQuery()
    {
        $dataTableService = new DataTableService(
            [
                new DataTableRow('id', 'ID', searchable: false),
                new DataTableRow('name', 'name'),
                new DataTableRow('actions', 'actions', searchable: false, sortable: false),
            ]
        );

        $query = $dataTableService->prepareQuery(
            Manufacturer::class
        );

        $query = $dataTableService->getResults($query);

        return ManufacturerResource::collection($query)
            ->additional([
                'columns' => DateTableRowResource::collection(
                    $dataTableService->getFields()
                ),
            ]);
    }

    /**
     * Stores manufacturer in the database
     *
     * @author Piotr Nagórny
     */
    public function storeManufacturer(
        ManufacturerRequest $request
    ): Manufacturer {
        return Manufacturer::create([
            'name' => $request->name,
        ]);
    }

    /**
     * Updates manufacturer data
     *
     * @author Piotr Nagórny
     */
    public function updateManufacturer(
        ManufacturerRequest $request,
        Manufacturer $manufacturer,
    ): bool {
        return $manufacturer->update([
            'name' => $request->name,
        ]);
    }

    /**
     * Removes the manufacturer from storage
     *
     * @author Piotr Nagórny
     */
    public function destroyManufacturer(
        Manufacturer $manufacturer
    ): bool|null {
        return $manufacturer->delete();
    }

    /**
     * Returns random manufacturer or creates one
     * if none exists
     *
     * @author Mariusz Waloszczyk
     */
    public static function getRandomManufacturer(): Manufacturer
    {
        $manufacturer = Manufacturer::inRandomOrder()->first();

        if (is_null($manufacturer)) {
            return Manufacturer::factory()
                ->create();
        }

        return $manufacturer;
    }
}
