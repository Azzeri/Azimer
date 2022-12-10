<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { closeModal } from "@/shared";
import InputText from "@/Components/Form/InputText.vue";
import Select from "@/Components/Form/Select.vue";
import Checkbox from "@/Components/Form/Checkbox.vue";
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    eqItemTemplatesSelect: Array,
    eqItemVehiclesSelect: Array,
    fireBrigadeUnitsSelect: Array,
});

const form = useForm({

});

const submit = () =>
    form.post("/eqItems", {
        onSuccess: () => {
            form.reset(),
            form.clearErrors(),
            closeModal("create-item-modal");
        },
    });
</script>
<template>
    <Modal id="create-item-modal" header="Create item">
        <template #content>
            <form @submit.prevent="submit">
             
            </form>
        </template>
    </Modal>
</template>
