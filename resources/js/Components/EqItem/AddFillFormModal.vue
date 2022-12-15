<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { closeModal } from "@/shared";
import InputDateTime from "@/Components/Form/InputDateTime.vue";
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    eqItem: Object,
});

const addFillForm = useForm({
    eq_item_code: props.eqItem.data.code,
    started_at: null,
    finished_at: null,
});

const modalName = "create-fill-modal";

const submit = () =>
    addFillForm.post("/eqFills", {
        onSuccess: () => {
            addFillForm.reset(),
                addFillForm.clearErrors(),
                closeModal(modalName);
        },
    });
</script>
<template>
    <Modal :id="modalName" header="add fill">
        <template #content>
            <form @submit.prevent="submit">
                <InputDateTime
                    :label="__('from')"
                    field="started_at"
                    :form="addFillForm"
                />
                <InputDateTime
                    :label="__('to')"
                    field="finished_at"
                    :form="addFillForm"
                />
                <div class="mt-4">
                    <button
                        class="btn w-full"
                        :disabled="addFillForm.processing"
                        type="submit"
                    >
                        {{ __("submit") }}
                    </button>
                </div>
            </form>
        </template>
    </Modal>
</template>
