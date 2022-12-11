const navigation = [
    {
        label: "Użytkownicy",
        link: "users.index",
        icon: "fa-solid fa-user",
        resources: [
            "res_users_overall",
            "res_users_own_unit",
            "res_users_lowly_units",
        ],
    },
    {
        label: "Sprzęt",
        icon: "fa-solid fa-house",
        resources: [],
        tabindex: "0",
        subNavigation: [
            {
                label: "Sprzęt",
                link: "eqItems.index",
                icon: "fa-solid fa-house",
                resources: [],
            },
            {
                label: "Zestawy",
                link: "dashboard",
                icon: "fa-solid fa-house",
                resources: [],
            },
            {
                label: "Pojazdy",
                link: "vehicles.index",
                icon: "fa-solid fa-house",
                resources: [],
            },
        ],
    },
    {
        label: "Abstrakcja",
        icon: "fa-solid fa-house",
        resources: [],
        tabindex: "0",
        subNavigation: [
            {
                label: "Kategorie",
                link: "eqItemCategories.index",
                icon: "fa-solid fa-house",
                resources: [],
            },
            {
                label: "Szablony",
                link: "eqItemTemplates.index",
                icon: "fa-solid fa-house",
                resources: [
                    "res_equipment_resources_overall"
                ],
            },
            {
                label: "Producenci",
                link: "manufacturers.index",
                icon: "fa-solid fa-house",
                resources: [],
            },
        ],
    },
    {
        label: "Jednostki",
        link: "fireBrigadeUnits.index",
        icon: "fa-solid fa-house",
        resources: [
            "res_fire_brigade_units_overall",
            "res_fire_brigade_unit_own",
            "res_fire_brigade_units_lowly",
        ],
    },
    {
        label: "Skaner",
        link: "dashboard",
        icon: "fa-solid fa-house",
        resources: [],
    },
];

export { navigation };
