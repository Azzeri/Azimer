<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import InputText from "@/Components/Form/InputText.vue";
import Select from "@/Components/Form/Select.vue";
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    eqItemCategory: Object,
    eqItemManufacturersSelect: Array,
});

const form = useForm({
    name: null,
    interval: null,
    eq_item_category_id: props.eqItemCategory.id,
    manufacturer_id: props.eqItemManufacturersSelect
        ? props.eqItemManufacturersSelect[0].value
        : null,
});

const submit = () => {
    form.post("/eqServiceTemplates", {
        onSuccess: () => {
            form.reset(),
                form.clearErrors(),
                closeModal("category-details-modal");
        },
    });
};
</script>
<template>
    <Modal
        id="category-details-modal"
        :header="eqItemCategory.name"
        :customWidth="'max-w-5xl'"
    >
        <template #content>
            <div class="flex mt-4 px-4">
                <div class="w-full" v-if="eqItemCategory.subcategories.length">
                    <h1 class="font-semibold">
                        {{ __("subcategories") }}
                    </h1>
                    <ul class="mt-4 space-y-3">
                        <li v-for="subcategory in eqItemCategory.subcategories">
                            {{ subcategory.name }}
                        </li>
                    </ul>
                </div>
                <div
                    class="w-full"
                    v-if="eqItemCategory.serviceTemplates.length"
                >
                    <h1 class="font-semibold">
                        {{ __("services") }}
                    </h1>
                    <ul class="mt-4 space-y-3">
                        <li v-for="template in eqItemCategory.serviceTemplates">
                            {{ template.name }}
                        </li>
                    </ul>
                </div>
                <div class="w-full">
                    <h1 class="font-semibold">
                        {{ __("new service") }}
                    </h1>
                    <form @submit.prevent="submit">
                        <div>
                            <InputText
                                :label="__('name')"
                                field="name"
                                :form="form"
                            />
                            <InputText
                                :label="__('interval')"
                                field="interval"
                                :form="form"
                            />
                            <Select
                                :label="__('manufacturer')"
                                field="manufacturer_id"
                                :form="form"
                                :options="eqItemManufacturersSelect"
                                :selected="form.manufacturer_id"
                            />
                        </div>
                        <div class="mt-4">
                            <button
                                class="btn w-full"
                                :disabled="form.processing"
                                type="submit"
                            >
                                {{ __("submit") }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    </Modal>
</template>
