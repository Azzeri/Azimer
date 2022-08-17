<script setup>
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";
import { openModal } from "@/shared.js";
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateFormModal from "@/Components/FireBrigadeUnit/CreateFormModal.vue";

defineProps({
    fireBrigadeUnits: Object,
    superiorUnitSelect: Array,
});
</script>

<template>
    <AppLayout title="Fire Brigade Units">
        <Table striped :resource="fireBrigadeUnits" class="mt-10">
            <template v-slot:tableFilter="slotProps">
                <button
                    @click="openModal('create-unit-modal')"
                    class="btn btn-sm"
                >
                    Dodaj
                </button>
            </template>
            <template #cell(actions)="{ item: unit }">
                <button @click="" class="btn btn-xs btn-info">Details</button>
            </template>
            <template #cell(superior_unit_id)="{ item: unit }">
                {{
                    unit.superior_fire_brigade_unit
                        ? unit.superior_fire_brigade_unit.name
                        : "-"
                }}
            </template>
        </Table>
        <CreateFormModal :superiorUnitSelect="superiorUnitSelect" />
    </AppLayout>
</template>
