<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { closeModal } from "@/shared";
import InputText from "@/Components/Form/InputText.vue";
import InputDate from "@/Components/Form/InputDate.vue";
import Select from "@/Components/Form/Select.vue";
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    eqItemTemplatesSelect: Array,
    eqItemVehiclesSelect: Array,
    fireBrigadeUnitsSelect: Array,
});

const modalName = "create-item-modal";

// const templateHasField = (field) => {
//     return (
//         storeEqItemForm.eq_item_template_id && props.eqItemTemplatesSelect.field
//     );
// };

const fields = {
    name: false,
    vehicle_number: false,
    construction_number: false,
    inventory_number: false,
    identification_number: false,
    date_expiry: false,
    date_legalisation: false,
    date_legalisation_due: false,
    date_production: false,
};

const matchFieldsToTemplate = (event) => {
    for (const [key, value] of Object.entries(fields)) {
        fields[key] = false;
    }

    let template = props.eqItemTemplatesSelect.find(
        (elem) => elem.value == event.target.value
    );

    for (const [key, value] of Object.entries(fields)) {
        if (template[key]) {
            fields[key] = true;
        }
    }
};

const storeEqItemForm = useForm({
    code: null,
    eq_item_template_id: null,
    fire_brigade_unit_id: props.fireBrigadeUnitsSelect
        ? props.fireBrigadeUnitsSelect[0].value
        : null,

    name: null,
    vehicle_number: null,
    construction_number: null,
    inventory_number: null,
    identification_number: null,
    date_expiry: null,
    date_legalisation: null,
    date_legalisation_due: null,
    date_production: null,
});

const submit = () =>
    storeEqItemForm.post("/eqItems", {
        onSuccess: () => {
            storeEqItemForm.reset(),
                storeEqItemForm.clearErrors(),
                closeModal(modalName);
        },
    });
</script>
<template>
    <Modal :id="modalName" customWidth="max-w-4xl" header="Create item">
        <template #content>
            <form @submit.prevent="submit">
                <div class="flex space-x-2">
                    <InputText
                        :label="__('code')"
                        field="code"
                        :form="storeEqItemForm"
                    />
                    <Select
                        @change="matchFieldsToTemplate($event)"
                        :label="__('template')"
                        field="eq_item_template_id"
                        :form="storeEqItemForm"
                        :options="eqItemTemplatesSelect"
                        :selected="storeEqItemForm.eq_item_template_id"
                    />
                    <Select
                        :label="__('unit')"
                        field="fire_brigade_unit_id"
                        :form="storeEqItemForm"
                        :options="fireBrigadeUnitsSelect"
                        :selected="storeEqItemForm.fire_brigade_unit_id"
                    />
                </div>
                <div class="divider"></div>
                <div class="grid grid-cols-3 gap-2">
                    <InputText
                        :label="__('name')"
                        field="name"
                        :form="storeEqItemForm"
                    />
                    <InputText
                        v-if="fields.inventory_number"
                        :label="__('inventory number')"
                        field="inventory_number"
                        :form="storeEqItemForm"
                    />
                    <InputText
                        v-if="fields.construction_number"
                        :label="__('construction number')"
                        field="construction_number"
                        :form="storeEqItemForm"
                    />
                    <InputText
                        v-if="fields.identification_number"
                        :label="__('identification number')"
                        field="identification_number"
                        :form="storeEqItemForm"
                    />
                    <InputDate
                        v-if="fields.date_expiry"
                        :label="__('date_expiry')"
                        field="date_expiry"
                        :form="storeEqItemForm"
                    />
                    <InputDate
                        v-if="fields.date_legalisation"
                        :label="__('date_legalisation')"
                        field="date_legalisation"
                        :form="storeEqItemForm"
                    />
                    <InputDate
                        v-if="fields.date_legalisation_due"
                        :label="__('date_legalisation_due')"
                        field="date_legalisation_due"
                        :form="storeEqItemForm"
                    />
                    <InputDate
                        v-if="fields.date_production"
                        :label="__('date_production')"
                        field="date_production"
                        :form="storeEqItemForm"
                    />
                </div>
                <div class="mt-4">
                    <button
                        class="btn"
                        :disabled="storeEqItemForm.processing"
                        type="submit"
                    >
                        Dodaj
                    </button>
                </div>
            </form>
        </template>
    </Modal>
</template>
