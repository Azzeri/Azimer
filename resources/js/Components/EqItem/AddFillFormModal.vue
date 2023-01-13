<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { closeModal } from "@/shared";
import InputDateTime from "@/Components/Form/InputDateTime.vue";
import Modal from "@/Components/Modal.vue";
import { ref } from "vue"

const props = defineProps({
    eqItem: Object,
});

const addFillForm = useForm({
    eq_item_code: props.eqItem.data.code,
    started_at: null,
    finished_at: null,
});

const modalName = "create-fill-modal";
let fixedSeconds = ref(0)

const setFillSeconds = () => {
    let date = new Date();
    addFillForm.started_at = date.toISOString().substring(0, 19)
    date.setSeconds(date.getSeconds() + parseInt(fixedSeconds.value))
    addFillForm.finished_at = date.toISOString().substring(0, 19)
}

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
            <label class="label">
                <span class="label-text"> seconds </span>
            </label>
            <input v-model="fixedSeconds" class="input input-primary input-sm" />
            <button @click="setFillSeconds" class="btn btn-sm ml-4">{{ __('calculate') }}</button>
            <form @submit.prevent="submit">
                <InputDateTime
                    showSeconds
                    :label="__('from')"
                    field="started_at"
                    :form="addFillForm"
                />
                <InputDateTime
                    showSeconds
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
