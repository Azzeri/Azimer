<script setup>
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";
import { openModal } from "@/shared.js";
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps({
    users: Object,
    fireBrigadeUnitSelect: Array,
});
</script>

<template>
    <AppLayout title="Users">
        <Table striped :resource="users" class="mt-10">
            <template v-slot:tableFilter="slotProps">
                <button @click="openModal('')" class="btn btn-sm">Dodaj</button>
            </template>
            <template #cell(actions)="{ item: user }">
                <button @click="" class="btn btn-xs btn-info">Details</button>
            </template>
            <template #cell(fire_brigade_unit_id)="{ item: user }">
                {{
                    user.fire_brigade_unit
                        ? user.fire_brigade_unit.name
                        : "-"
                }}
            </template>
            <template #cell(phone)="{ item: user }">
                {{ user.phone || "-" }}
            </template>
        </Table>
    </AppLayout>
</template>
