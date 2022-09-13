<script setup>
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";
import { openModal } from "@/shared.js";
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateFormModal from "@/Components/EqItemTemplate/CreateFormModal.vue";
import { Inertia } from "@inertiajs/inertia";

defineProps({
    eqItemTemplates: Object,
    eqItemManufacturersSelect: Array,
    eqItemCategoriesSelect: Array,
});
</script>

<template>
    <AppLayout title="Equipment templates">
        <Table striped :resource="eqItemTemplates" class="mt-10">
            <template v-slot:tableFilter="slotProps">
                <button
                    @click="openModal('create-template-modal')"
                    class="btn btn-sm"
                >
                    Dodaj
                </button>
            </template>
            <template #cell(actions)="{ item: template }">
                <button
                    @click="
                        Inertia.delete(
                            route('eqItemTemplates.destroy', template.id)
                        )
                    "
                    class="ml-2 btn btn-xs btn-error"
                >
                    Usuń
                </button>
            </template>
            <template #cell(eq_item_category_id)="{ item: template }">
                {{ template.eq_item_category_id }} //temporary
            </template>
            <template #cell(manufacturer_id)="{ item: template }">
                {{ template.manufacturer.name }}
            </template>
        </Table>
    </AppLayout>
    <CreateFormModal
        :eqItemManufacturersSelect="eqItemManufacturersSelect"
        :eqItemCategoriesSelect="eqItemCategoriesSelect"
    />
</template>
