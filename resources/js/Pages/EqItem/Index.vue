<script setup>
import DataTable from '@/Components/DataTable/DataTable.vue'
import { openModal } from "@/shared.js";
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateFormModal from "@/Components/EqItem/CreateFormModal.vue";
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
		eqItems: Object,
		eqItemTemplatesSelect: Array,
		eqItemVehiclesSelect: Array,
		fireBrigadeUnitsSelect: Array,
    filters: Object,
});

</script>

<template>
    <AppLayout title="Items">
        <DataTable :data=eqItems :filters=filters sortRoute="eqItems.index">
					<template #buttons>
						<button @click="openModal('create-item-modal')" 
							class="btn btn-primary w-full sm:w-auto sm:btn-sm">
							<i class="fas fa-plus mr-2"></i>
							{{ __("new item") }}
						</button>
					</template>

					<template #content>
						<tr v-for="row in eqItems.data" :key="row" class="hover">
							<th class="font-bold">{{ row.code }}</th>
							<td>{{ row.eq_item_template.name }}</td>
							<td>{{ row.fire_brigade_unit.name }}</td>
							<td class="space-x-2 text-center">
								<Link 
									:href="route('eqItems.show', row.code)"
									as="button"
									class="btn btn-xs btn-primary"
								>
									{{ __("details") }}
								</Link>
							</td>
						</tr>
					</template>
				</DataTable>
        <CreateFormModal 
            :eqItemTemplatesSelect="eqItemTemplatesSelect"
            :eqItemVehiclesSelect="eqItemVehiclesSelect" 
            :fireBrigadeUnitsSelect="fireBrigadeUnitsSelect" 
        />
    </AppLayout>
</template>
