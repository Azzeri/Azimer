<?php

namespace App\Helpers;

/**
 * Row representation for datatables
 *
 * @author Mariusz Waloszczyk
 */
class DataTableRow
{
    /**
     * @author Mariusz Waloszczyk
     */
    public function __construct(
        private string $name,
        private string $label,
        private bool $sortable = true,
        private bool $searchable = true,
    ) {
    }

    /**
     * @author Mariusz Waloszczyk
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @author Mariusz Waloszczyk
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @author Mariusz Waloszczyk
     */
    public function getSortable(): bool
    {
        return $this->sortable;
    }

    /**
     * @author Mariusz Waloszczyk
     */
    public function getSearchable(): bool
    {
        return $this->searchable;
    }
}
