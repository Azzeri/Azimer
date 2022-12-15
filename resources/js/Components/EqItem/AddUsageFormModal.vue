<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { closeModal } from "@/shared";
import InputDateTime from "@/Components/Form/InputDateTime.vue";
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    eqItem: Object,
});

const addUsageForm = useForm({
    eq_item_code: props.eqItem.data.code,
    usage_start: null,
    usage_end: null,
});

const modalName = "create-usage-modal";

const submit = () =>
    addUsageForm.post("/eqUsages", {
        onSuccess: () => {
            addUsageForm.reset(),
                addUsageForm.clearErrors(),
                closeModal(modalName);
        },
    });
</script>
<template>
    <Modal :id="modalName" header="add usage">
        <template #content>
            <form @submit.prevent="submit">
                <InputDateTime
                    :label="__('from')"
                    field="usage_start"
                    :form="addUsageForm"
                />
                <InputDateTime
                    :label="__('to')"
                    field="usage_end"
                    :form="addUsageForm"
                />
                <div class="mt-4">
                    <button
                        class="btn w-full"
                        :disabled="addUsageForm.processing"
                        type="submit"
                    >
                        {{ __("submit") }}
                    </button>
                </div>
            </form>
        </template>
    </Modal>
</template>
