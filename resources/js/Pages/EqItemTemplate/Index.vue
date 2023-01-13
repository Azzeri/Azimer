<script setup>
import DataTable from '@/Components/DataTable/DataTable.vue'
import { openModal } from "@/shared.js";
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateFormModal from "@/Components/EqItemTemplate/CreateFormModal.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia';

defineProps({
    eqItemTemplates: Object,
    eqItemManufacturersSelect: Array,
    eqItemCategoriesSelect: Array,
    filters: Object,
});

const deleteTemplate = (id) => {
	Inertia.delete(route('eqItemTemplates.destroy', id))
}

</script>

<template>
    <AppLayout title="Templates">
        <DataTable :data=eqItemTemplates :filters=filters sortRoute="eqItemTemplates.index">
					<template #buttons>
						<button @click="openModal('create-template-modal')" 
							class="btn btn-primary w-full sm:w-auto sm:btn-sm">
							<i class="fas fa-plus mr-2"></i>
							{{ __("new template") }}
						</button>
					</template>

					<template #content>
						<tr v-for="row in eqItemTemplates.data" :key="row" class="hover">
							<th class="font-bold">{{ row.id }}</th>
							<td>{{ row.eq_item_category.name }}</td>
							<td>{{ row.manufacturer.name }}</td>
							<td class="space-x-2 text-center">
								<button class="btn btn-xs btn-primary">Szczegóły</button>
								<button class="btn btn-xs btn-error" @click="deleteTemplate(row.id)">{{ __('delete') }}</button>
							</td>
						</tr>
					</template>
				</DataTable>
        <CreateFormModal 
            :eqItemManufacturersSelect="eqItemManufacturersSelect"
            :eqItemCategoriesSelect="eqItemCategoriesSelect" 
        />
    </AppLayout>
</template>
