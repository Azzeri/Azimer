<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { closeModal } from "@/shared";
import InputText from "@/Components/Form/InputText.vue";
import Select from "@/Components/Form/Select.vue";
import Checkbox from "@/Components/Form/Checkbox.vue";
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    eqItemCategorySelect: Array,
});

const form = useForm({
    name: null,
    is_fillable: false,
    parent_category_id: null,
});

const submit = () =>
    form.post("/eqItemCategories", {
        onSuccess: () => {
            form.reset(), form.clearErrors(), closeModal("create-category-modal");
        },
    });
</script>
<template>
    <Modal id="create-category-modal" header="Create category">
        <template #content>
            <form @submit.prevent="submit">
                <div>
                    <InputText :label="__('name')" field="name" :form="form" />
                    <Select
                        :label="__('parent category')"
                        field="parent_category_id"
                        :form="form"
                        :options="eqItemCategorySelect"
                        :selected="form.parent_category_id"
                    />
                    <Checkbox
                        :label="__('fillable')"
                        field="is_fillable"
                        :form="form"
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
