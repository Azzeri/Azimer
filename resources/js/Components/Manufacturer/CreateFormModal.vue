<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { closeModal } from "@/shared";
import InputText from "@/Components/Form/InputText.vue";
import Modal from "@/Components/Modal.vue";

const form = useForm({
    name: null,
});

const submit = () =>
    form.post("/manufacturers", {
        onSuccess: () => {
            form.reset(),
            form.clearErrors(),
            closeModal("create-manufacturer-modal");
        },
    });
</script>
<template>
    <Modal id="create-manufacturer-modal" header="Create manufacturer">
        <template #content>
            <form @submit.prevent="submit">
                <div>
                    <InputText label="Imię" field="name" :form="form" />
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
