export const navigation = [
    {
        label: "nav_equipment",
        icon: "fa-solid fa-fire-extinguisher",
        tabindex: "0",
        resources: [
            'res_overall_equipment',
            'res_own_unit_equipment',
            'res_lowly_units_equipment',
        ],
        subNavigation: [
            {
                label: "nav_equipment",
                link: "eqItems.index",
                icon: "fa-solid fa-fire-extinguisher",
                resources: [
                    'res_overall_equipment',
                    'res_own_unit_equipment',
                    'res_lowly_units_equipment',
                ],
            },
            {
                label: "nav_sets",
                link: "dashboard",
                icon: "fa-solid fa-toolbox",
                resources: [
                    'res_overall_equipment',
                    'res_own_unit_equipment',
                    'res_lowly_units_equipment',
                ],
            },
            {
                label: "nav_vehicles",
                link: "vehicles.index",
                icon: "fa-solid fa-truck",
                resources: [
                    'res_overall_equipment',
                    'res_own_unit_equipment',
                    'res_lowly_units_equipment',
                ],
            },
            {
                label: "nav_scan",
                link: "dashboard",
                icon: "fa-solid fa-qrcode",
                resources: [
                    'res_overall_equipment',
                    'res_own_unit_equipment',
                    'res_lowly_units_equipment',
                ],
            },
        ],
    },
    {
        label: "nav_resources",
        icon: "fa-solid fa-warehouse",
        tabindex: "0",
        resources: [
            'res_overall_equipment_resources'
        ],
        subNavigation: [
            {
                label: "nav_categories",
                link: "eqItemCategories.index",
                icon: "fa-solid fa-list",
                resources: [
                    'res_overall_equipment_resources'
                ],
            },
            {
                label: "nav_templates",
                link: "eqItemTemplates.index",
                icon: "fa-solid fa-list-ul",
                resources: [
                    'res_overall_equipment_resources'
                ],
            },
            {
                label: "nav_manufacturers",
                link: "manufacturers.index",
                icon: "fa-solid fa-industry",
                resources: [
                    'res_overall_equipment_resources',
                ],
            },
        ],
    },
    {
        label: "nav_users",
        icon: "fa-solid fa-user",
        tabindex: "0",
        resources: [
            'res_overall_users',
            'res_own_unit_users',
            'res_lowly_units_users',
            'res_overall_fire_brigade_units',
            'res_own_unit_fire_brigade_unit',
            'res_lowly_units_fire_brigade_unit',
        ],
        subNavigation: [
            {
                label: "nav_users",
                link: "users.index",
                icon: "fa-solid fa-user",
                resources: [
                    'res_overall_users',
                    'res_own_unit_users',
                    'res_lowly_units_users',
                ],
            },
            {
                label: "nav_permissions",
                link: "aclRoles.index",
                icon: "fa-solid fa-user-graduate",
                resources: [
                    'res_overall_users',
                    'res_own_unit_users',
                    'res_lowly_units_users',
                ],
            },
            {
                label: "nav_units",
                link: "fireBrigadeUnits.index",
                icon: "fa-solid fa-house-fire",
                resources: [
                    'res_overall_fire_brigade_units',
                    'res_own_unit_fire_brigade_unit',
                    'res_lowly_units_fire_brigade_unit',
                ],
            },
        ],
    },
];
