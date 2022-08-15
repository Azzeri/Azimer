<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { closeModal } from "@/shared";
import InputText from "@/Components/Form/InputText.vue";
import Select from "@/Components/Form/Select.vue";
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    superiorUnitSelect: Array,
});

const form = useForm({
    name: null,
    addr_street: null,
    addr_number: null,
    addr_postcode: null,
    addr_locality: null,
    superior_unit_id: null,
});

const submit = () =>
    form.post("/fireBrigadeUnits", {
        onSuccess: () => {
            form.reset(), form.clearErrors(), closeModal("create-unit-modal");
        },
    });
</script>
<template>
    <Modal id="create-unit-modal" header="Create fire brigade unit">
        <template #content>
            <form @submit.prevent="submit">
                <div class="flex justify-between mt-2">
                    <div>
                        <h1 class="font-semibold">Dane jednostki</h1>
                        <InputText
                            label="Nazwa jednostki"
                            field="name"
                            :form="form"
                        />
                        <Select
                            label="Jednostka nadrzędna"
                            field="superior_unit_id"
                            :form="form"
                            :options="superiorUnitSelect"
                            :selected="form.superior_unit_id"
                        />
                    </div>
                    <div>
                        <h1 class="font-semibold">Adres</h1>
                        <InputText
                            label="Ulica"
                            field="addr_street"
                            :form="form"
                        />
                        <InputText
                            label="Numer"
                            field="addr_number"
                            :form="form"
                        />
                        <InputText
                            label="Kod pocztowy"
                            field="addr_postcode"
                            :form="form"
                        />
                        <InputText
                            label="Miejscowość"
                            field="addr_locality"
                            :form="form"
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
