<script setup>
import InputText from "@/Components/Form/InputText.vue";
import InputDate from "@/Components/Form/InputDate.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Select from "@/Components/Form/Select.vue";

const props = defineProps({
    eqItem: Object,
    fireBrigadeUnitsSelect: Array,
    eqItemVehiclesSelect: Array,
});

const itemData = props.eqItem.data;

const editItemForm = useForm({
    code: itemData.code,
    fire_brigade_unit_id: itemData.fire_brigade_unit.id,
    construction_number: itemData.construction_number,
    inventory_number: itemData.inventory_number,
    identification_number: itemData.identification_number,
    date_expiry: itemData.date_expiry,
    date_legalisation: itemData.date_legalisation,
    date_legalisation_due: itemData.date_legalisation_due,
    date_production: itemData.date_production,
    vehicle_number: itemData.vehicle ? itemData.vehicle.number : null,
});
</script>
<template>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-2 md:mt-4">
        <InputText :label="__('code')" field="code" :form="editItemForm" />
        <InputText
            :label="__('category')"
            :value="itemData.eq_item_template.eq_item_category.name"
        />
        <InputText
            :label="__('manufacturer')"
            :value="itemData.eq_item_template.manufacturer.name"
        />
        <InputText
            :label="__('template')"
            :value="itemData.eq_item_template.name"
        />
        <Select
            :label="__('fire brigade unit')"
            field="fire_brigade_unit_id"
            :form="editItemForm"
            :options="fireBrigadeUnitsSelect"
            :selected="editItemForm.fire_brigade_unit_id"
        />
    </div>
    <div class="divider" />

    <div class="collapse collapse-arrow">
        <input type="checkbox" :checked="true" class="w-full" />
        <div class="collapse-title text-xl font-medium pl-0">
            {{ __("details") }}
        </div>
        <div class="collapse-content p-0">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-2">
                <InputText
                    v-if="itemData.eq_item_template.has_construction_number"
                    :label="__('construction number')"
                    field="construction_number"
                    :form="editItemForm"
                />
                <InputText
                    v-if="itemData.eq_item_template.has_inventory_number"
                    :label="__('inventory number')"
                    field="inventory_number"
                    :form="editItemForm"
                />
                <InputText
                    v-if="itemData.eq_item_template.has_identification_number"
                    :label="__('identification number')"
                    field="identification_number"
                    :form="editItemForm"
                />
                <InputDate
                    v-if="itemData.eq_item_template.has_date_expiry"
                    :label="__('date expiry')"
                    field="date_expiry"
                    :form="editItemForm"
                />
                <InputDate
                    v-if="itemData.eq_item_template.has_date_legalisation"
                    :label="__('date legalisation')"
                    field="date_legalisation"
                    :form="editItemForm"
                />
                <InputDate
                    v-if="itemData.eq_item_template.has_date_legalisation_due"
                    :label="__('date legalisation due')"
                    field="date_legalisation_due"
                    :form="editItemForm"
                />
                <InputDate
                    v-if="itemData.eq_item_template.has_date_production"
                    :label="__('date production')"
                    field="date_production"
                    :form="editItemForm"
                />
                <Select
                    v-if="itemData.eq_item_template.has_vehicle"
                    :label="__('vehicle')"
                    field="vehicle_number"
                    :form="editItemForm"
                    :options="eqItemVehiclesSelect"
                    :selected="editItemForm.vehicle_number"
                />
            </div>
        </div>
    </div>
</template>
