<script setup>
import DataTable from '@/Components/DataTable/DataTable.vue'
import { openModal } from "@/shared.js";
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateFormModal from "@/Components/Manufacturer/CreateFormModal.vue";
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    manufacturers: Object,
    filters: Object,
});

</script>

<template>
    <AppLayout title="Manufacturers">
        <DataTable :data=manufacturers :filters=filters sortRoute="manufacturers.index">
					<template #buttons>
						<button @click="openModal('create-manufacturer-modal')" 
							class="btn btn-primary w-full sm:w-auto sm:btn-sm">
							<i class="fas fa-plus mr-2"></i>
							{{ __("new manufacturers") }}
						</button>
					</template>

					<template #content>
						<tr v-for="row in manufacturers.data" :key="row" class="hover">
							<th class="font-bold">{{ row.id }}</th>
							<td>{{ row.name }}</td>
							<td class="space-x-2 text-center">
								<button class="btn btn-xs btn-primary">{{ __('details') }}</button>
								<button class="btn btn-xs btn-error">{{ __('delete') }}</button>
							</td>
						</tr>
					</template>
				</DataTable>
        <CreateFormModal />
    </AppLayout>
</template>
