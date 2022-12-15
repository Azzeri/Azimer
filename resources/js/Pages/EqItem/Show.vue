<script setup>
import { openModal } from "@/shared.js";
import AppLayout from "@/Layouts/AppLayout.vue";
import EqItemData from "@/Components/EqItem/EqItemData.vue";
import ServiceTemplates from "@/Components/EqItem/ServiceTemplates.vue";
import Services from "@/Components/EqItem/Services.vue";
import AddUsageFormModal from "@/Components/EqItem/AddUsageFormModal.vue";
import AddFillFormModal from "@/Components/EqItem/AddFillFormModal.vue";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";

const props = defineProps({
    eqItem: Object,
    fireBrigadeUnitsSelect: Array,
    eqItemVehiclesSelect: Array,
});

const breadcrumbs = [
    {
        url: "eqItems.index",
        label: "items",
    },
];

const isCategoryFillable = () => {
    return props.eqItem.data.eq_item_template.eq_item_category.is_fillable;
};
</script>

<template>
    <AppLayout title="Items">
        <Breadcrumbs :links="breadcrumbs" :lastLabel="eqItem.data.code" />
        <EqItemData
            :eqItem="eqItem"
            :fireBrigadeUnitsSelect="fireBrigadeUnitsSelect"
            :eqItemVehiclesSelect="eqItemVehiclesSelect"
        />

        <div class="divider" />

        <div class="flex space-x-2">
            <button
                @click="openModal('create-usage-modal')"
                class="btn btn-primary btn-sm"
            >
                <i class="fas fa-plus mr-2"></i>
                {{ __("new usage") }}
            </button>
            <button
                v-if="isCategoryFillable()"
                @click="openModal('create-fill-modal')"
                class="btn btn-primary btn-sm"
            >
                <i class="fas fa-plus mr-2"></i>
                {{ __("new fill") }}
            </button>
        </div>

        <div class="divider" />

        <ServiceTemplates :eqItem="eqItem" />
        <Services :eqItem="eqItem" />

        <AddUsageFormModal :eqItem="eqItem" />
        <AddFillFormModal v-if="isCategoryFillable()" :eqItem="eqItem" />
    </AppLayout>
</template>
