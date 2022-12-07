<script setup>
import DataTable from '@/Components/DataTable/DataTable.vue'
import { openModal } from "@/shared.js";
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateFormModal from "@/Components/EqItemCategory/CreateFormModal.vue";
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
		categories: Object,
		eqItemCategorySelect: Array,
    filters: Object,
});

const assignIconToBoolean = (is_fillable) => {
	return is_fillable
		? '<i class="fa-regular fa-xl fa-circle-check text-success" />'
		: '<i class="fa-regular fa-xl fa-circle-xmark text-error" />';
}

const modalName = 'create-category-modal';

</script>

<template>
    <AppLayout :title="__('categories')">
        <DataTable :data=categories :filters=filters sortRoute="eqItemCategories.index">
					<template #buttons>
						<button @click="openModal(modalName)" 
							class="btn btn-primary w-full sm:w-auto sm:btn-sm">
							<i class="fas fa-plus mr-2"></i>
							{{ __("new category") }}
						</button>
					</template>

					<template #content>
						<tr v-for="row in categories.data" :key="row" class="hover">
							<th class="font-bold">{{ row.id }}</th>
							<td>{{ row.name }}</td>
							<td>{{ row.parent_category ? row.parent_category.name : '-' }}</td>
							<td :innerHTML="assignIconToBoolean(row.is_fillable)" />
							<td class="space-x-2 text-center">
								<button class="btn btn-xs btn-primary">{{ __('details') }}</button>
								<button class="btn btn-xs btn-error">{{ __('delete') }}</button>
							</td>
						</tr>
					</template>
				</DataTable>
        <CreateFormModal :eqItemCategorySelect="eqItemCategorySelect" />
    </AppLayout>
</template>
