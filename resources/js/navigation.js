const navigation = [
    {
        label: "Users",
        link: "dashboard",
        icon: "fa-solid fa-house",
        resources: [],
    },
    {
        label: "Items",
        icon: "fa-solid fa-house",
        resources: [],
        tabindex: "0",
        subNavigation: [
            {
                label: "Categories",
                link: "dashboard",
                icon: "fa-solid fa-house",
                resources: [],
            },
            {
                label: "Items",
                link: "dashboard",
                icon: "fa-solid fa-house",
                resources: [],
            },
            {
                label: "Templates",
                link: "dashboard",
                icon: "fa-solid fa-house",
                resources: [],
            },
            {
                label: "Sets",
                link: "dashboard",
                icon: "fa-solid fa-house",
                resources: [],
            },
            {
                label: "Manufacturers",
                link: "dashboard",
                icon: "fa-solid fa-house",
                resources: [],
            },
            {
                label: "Vehicles",
                link: "dashboard",
                icon: "fa-solid fa-house",
                resources: [],
            },
        ],
    },
    {
        label: "Units",
        link: "fireBrigadeUnits.index",
        icon: "fa-solid fa-house",
        resources: [
            "res_fire_brigade_units_overall",
            "res_fire_brigade_unit_own",
            "res_fire_brigade_units_lowly",
        ],
    },
    {
        label: "Scanner",
        link: "dashboard",
        icon: "fa-solid fa-house",
        resources: [],
    },
];

export { navigation };
