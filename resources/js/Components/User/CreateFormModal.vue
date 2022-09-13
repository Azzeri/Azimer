<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { closeModal } from "@/shared";
import InputText from "@/Components/Form/InputText.vue";
import Select from "@/Components/Form/Select.vue";
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    fireBrigadeUnitSelect: Array,
});

const form = useForm({
    name: null,
    surname: null,
    email: null,
    phone: null,
    fire_brigade_unit_id: null,
});

const submit = () =>
    form.post("/users", {
        onSuccess: () => {
            form.reset(), form.clearErrors(), closeModal("create-user-modal");
        },
    });
</script>
<template>
    <Modal id="create-user-modal" header="Create user">
        <template #content>
            <form @submit.prevent="submit">
                <div>
                    <InputText label="Imię" field="name" :form="form" />
                    <InputText label="Nazwisko" field="surname" :form="form" />
                    <InputText
                        label="Adres e-mail"
                        field="email"
                        :form="form"
                    />
                    <InputText label="Nr telefonu" field="phone" :form="form" />
                    <Select
                        label="Jednostka"
                        field="fire_brigade_unit_id"
                        :form="form"
                        :options="fireBrigadeUnitSelect"
                        :selected="form.fire_brigade_unit_id"
                    />
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
