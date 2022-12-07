<script setup>
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";
import DataTable from '@/Components/DataTable/DataTable.vue'
import { openModal } from "@/shared.js";
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateFormModal from "@/Components/User/CreateFormModal.vue";
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    users: Object,
    fireBrigadeUnitSelect: Array,
    filters: Object,
});

</script>

<template>
    <AppLayout title="Users">
        <DataTable :data=users :filters=filters sortRoute="users.index">
					<template #buttons>
						<button @click="openModal('create-user-modal')" 
							class="btn btn-primary w-full sm:w-auto sm:btn-sm">
							<i class="fas fa-plus mr-2"></i>
							{{ __("new user") }}
						</button>
					</template>

					<template #content>
						<tr v-for="row in users.data" :key="row" class="hover">
							<th class="font-bold">{{ row.id }}</th>
							<td>{{ row.name }}</td>
							<td>{{ row.surname }}</td>
							<td>{{ row.email }}</td>
							<td>{{ row.fire_brigade_unit ? row.fire_brigade_unit.name : '-' }}</td>
							<td class="space-x-2 text-center">
								<button class="btn btn-xs btn-primary">Szczegóły</button>
							</td>
						</tr>
					</template>
				</DataTable>
        <CreateFormModal :fireBrigadeUnitSelect="fireBrigadeUnitSelect" />
    </AppLayout>
</template>
