<?php

namespace App\Services;

use Illuminate\Validation\Rule;

/**
 * Class for handling datatable operations
 *
 * @author Mariusz Waloszczyk
 */
class DataTableService
{
    const DEFAULT_PAGINATION_SIZE = 15;

    private array $sortableFields;

    private array $searchableFields;

    public function __construct(
        private array $fields
    ) {
    }

    /**
     * Prepares query to fetch data
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function prepareQuery(
        string $class,
        array $relations,
    ) {
        $this->prepareFields();

        $this->validateParameters();

        $query = $class::with($relations);

        $this->filterQuery($query);

        $this->sortQuery($query);

        return $query;
    }

    /**
     * Return list of models
     *
     * @param \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     *
     * @author Mariusz Waloszczyk
     */
    public function getResults(
        $query,
    ) {
        $pageSize = request('pageSize') ?: self::DEFAULT_PAGINATION_SIZE;

        return $query->paginate($pageSize)->withQueryString();
    }

    /**
     * @author Mariusz Waloszczyk
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Returns required filters
     *
     * @author Mariusz Waloszczyk
     */
    public static function getFilters(): array
    {
        return request()->all(['search', 'field', 'direction', 'pageSize']);
    }

    /**
     * Validates request parameters
     *
     * @author Mariusz Waloszczyk
     */
    private function validateParameters(): void
    {
        request()->validate([
            'direction' => [
                Rule::in(['asc', 'desc']),
            ],
            'field' => [
                Rule::in($this->sortableFields),
            ],
        ]);
    }

    /**
     * Sorts query by parameters
     *
     * @param \Illuminate\Database\Eloquent\Builder
     *
     * @author Mariusz Waloszczyk
     */
    private function sortQuery(
        $query,
    ): void {
        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        } else {
            $query->orderBy($this->sortableFields[0]);
        }
    }

    /**
     * Search for a string in given fields
     *
     * @param \Illuminate\Database\Eloquent\Builder
     *
     * @author Mariusz Waloszczyk
     */
    private function filterQuery(
        $query,
    ): void {
        if (request('search')) {
            foreach ($this->searchableFields as $field) {
                $query->orWhere($field, 'LIKE', '%'.request('search').'%');
            }
        }
    }

    /**
     * Assigns field names to proper arrays
     *
     * @author Mariusz Waloszczyk
     */
    private function prepareFields(): void
    {
        foreach ($this->fields as $field) {
            if ($field->getSortable()) {
                $this->sortableFields[] = $field->getName();
            }

            if ($field->getSearchable()) {
                $this->searchableFields[] = $field->getName();
            }
        }
    }
}
