<script setup>
import DataTable from '@/Components/DataTable/DataTable.vue'
import { openModal } from "@/shared.js";
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateFormModal from "@/Components/FireBrigadeUnit/CreateFormModal.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

defineProps({
    fireBrigadeUnits: Object,
    superiorUnitSelect: Array,
    filters: Object,
});
</script>

<template>
    <AppLayout title="Fire Brigade Units">
        <DataTable :data=fireBrigadeUnits :filters=filters sortRoute="fireBrigadeUnits.index">
            <template #buttons>
                <button @click="openModal('create-unit-modal')" 
                    class="btn btn-primary w-full sm:w-auto sm:btn-sm">
                    <i class="fas fa-plus mr-2"></i>
                   {{ __("new unit") }}
                </button>
            </template>

            <template #content>
                <tr v-for="row in fireBrigadeUnits.data" :key="row" class="hover">
                    <th class="font-bold">{{ row.id }}</th>
                    <td>{{ row.name }}</td>
                    <td>{{ row.addr_locality }}</td>
                    <td>{{ 
                        row.superior_fire_brigade_unit 
                            ? row.superior_fire_brigade_unit.name 
                            : '-' 
                    }}</td>
                    <td class="space-x-2 text-center">
                        <button class="btn btn-xs btn-primary">Szczegóły</button>
                    </td>
                </tr>
            </template>
        </DataTable>
        <CreateFormModal :superiorUnitSelect="superiorUnitSelect" />
    </AppLayout>
</template>
