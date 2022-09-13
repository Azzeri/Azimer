<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { closeModal } from "@/shared";
import InputText from "@/Components/Form/InputText.vue";
import Select from "@/Components/Form/Select.vue";
import Checkbox from "@/Components/Form/Checkbox.vue";
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    eqItemManufacturersSelect: Array,
    eqItemCategoriesSelect: Array,
});

const form = useForm({
    name: null,
    eq_item_category_id: props.eqItemCategoriesSelect
        ? props.eqItemCategoriesSelect[0].value
        : null,
    manufacturer_id: props.eqItemManufacturersSelect
        ? props.eqItemManufacturersSelect[0].value
        : null,
    has_vehicle: false,
    has_construction_number: false,
    has_inventory_number: false,
    has_identification_number: false,
    has_date_expiry: false,
    has_date_legalisation: false,
    has_date_legalisation_due: false,
    has_date_production: false,
});

const submit = () =>
    form.post("/eqItemTemplates", {
        onSuccess: () => {
            form.reset(),
                form.clearErrors(),
                closeModal("create-template-modal");
        },
    });
</script>
<template>
    <Modal id="create-template-modal" header="Nowy szablon">
        <template #content>
            <form @submit.prevent="submit">
                <InputText label="Nazwa" field="name" :form="form" />
                <Select
                    label="Kategoria"
                    field="eq_item_category_id"
                    :form="form"
                    :options="eqItemCategoriesSelect"
                    :selected="form.eq_item_category_id"
                />
                <Select
                    label="Producent"
                    field="manufacturer_id"
                    :form="form"
                    :options="eqItemManufacturersSelect"
                    :selected="form.manufacturer_id"
                />
                <div class="flex mt-4">
                    <div class="w-1/2">
                        <Checkbox
                            label="Nr seryjny"
                            :form="form"
                            field="has_construction_number"
                        />
                        <Checkbox
                            label="Nr inwentarzowy"
                            :form="form"
                            field="has_inventory_number"
                        />
                        <Checkbox
                            label="Nr identyfikacyjny"
                            :form="form"
                            field="has_identification_number"
                        />
                        <Checkbox
                            label="Pojazd"
                            :form="form"
                            field="has_vehicle"
                        />
                    </div>
                    <div class="w-1/2">
                        <Checkbox
                            label="Data produkcji"
                            :form="form"
                            field="has_date_production"
                        />
                        <Checkbox
                            label="Data ważności"
                            :form="form"
                            field="has_date_expiry"
                        />
                        <Checkbox
                            label="Data legalizacji"
                            :form="form"
                            field="has_date_legalisation"
                        />
                        <Checkbox
                            label="Termin legalizacji"
                            :form="form"
                            field="has_date_legalisation_due"
                        />
                    </div>
                </div>
                <div class="mt-4">
                    <button
                        class="btn w-full"
                        :disabled="form.processing"
                        type="submit"
                    >
                        Dodaj
                    </button>
                </div>
            </form>
        </template>
    </Modal>
</template>
