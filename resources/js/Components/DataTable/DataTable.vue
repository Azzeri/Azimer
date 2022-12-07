<template>
    <!-- Table heading -->
    <div
        class="space-y-2 sm:space-y-0 sm:flex justify-between mt-4 sm:space-x-5 w-full sm:w-auto"
    >
        <!-- Buttons -->
        <div
            class="flex flex-col sm:flex-row items-center space-y-3 sm:space-y-0 sm:space-x-2"
        >
            <slot name="buttons"></slot>
        </div>

        <!-- Search -->
        <div class="relative">
            <input
                v-model="params.search"
                placeholder="Szukaj"
                class="w-full pr-16 input input-primary sm:input-sm input-bordered"
                type="text"
            />
            <button
                class="absolute top-0 right-0 rounded-l-none btn sm:btn-sm btn-primary hover:bg-primary cursor-default no-animation"
            >
                <i class="fas fa-lg fa-search"></i>
            </button>
        </div>
    </div>

    <!-- Table content -->
    <div class="overflow-x-auto mt-4">
        <table class="table sm:table-compact w-full">
            <thead>
                <tr>
                    <th
                        v-for="column in data.columns"
                        :key="column"
                        @click="column.sortable ? sort(column) : true"
                        class="text-neutral-content"
                        style="background-color: #3d4451"
                    >
                        <div
                            class="flex justify-between items-center space-x-2"
                        >
                            <span>{{ __(column.label) }}</span>
                            <i
                                v-if="
                                    params.field === column.name &&
                                    params.direction === 'asc'
                                "
                                class="fas fa-sort-up"
                            ></i>
                            <i
                                v-else-if="
                                    params.field === column.name &&
                                    params.direction === 'desc'
                                "
                                class="fas fa-sort-down"
                            ></i>
                            <i
                                v-else-if="column.sortable"
                                class="fas fa-sort"
                            ></i>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <slot name="content"></slot>
            </tbody>
            <tfoot v-if="data.data.length">
                <tr>
                    <th
                        v-for="column in data.columns"
                        :key="column"
                        class="text-neutral-content"
                        style="background-color: #3d4451"
                    >
                        {{ column.label }}
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Table footer -->
    <div
        class="w-full sm:w-auto flex-col flex sm:flex-row-reverse justify-between py-3 text-center space-y-4 sm:space-y-0 pl-1 items-center sm:text-sm"
    >
        <DataTablePagination :meta="data.meta"></DataTablePagination>
        <span v-if="data.meta.total">
            <select
                class="select select-bordered select-sm text-sm"
                @change="pageSize($event)"
                v-model="params.pageSize"
            >
                <option v-for="option in pageSizeOptions" :value="option">
                    {{ option }}
                </option>
            </select>
            Wyniki od {{ data.meta.from }} do {{ data.meta.to }}. Łącznie
            {{ data.meta.total }} wyników.
        </span>
        <span v-else>Brak wyników</span>
    </div>
</template>

<script setup>
import DataTablePagination from "@/Components/DataTable/DataTablePagination.vue";
import { reactive, ref } from "vue";

const props = defineProps({
    data: Object,
    filters: Object,
    sortRoute: String,
});

const params = reactive({
    search: props.filters.search,
    field: props.filters.field,
    direction: props.filters.direction,
    pageSize: props.filters.pageSize ?? ref(15),
});

const sort = (field) => {
    params.field = field.name;
    params.direction = params.direction === "asc" ? "desc" : "asc";
};

const pageSize = (event) => {
    params.pageSize = event.target.value;
};

const pageSizeOptions = [15, 30, 100];
</script>

<script>
import { pickBy, throttle } from "lodash";

export default {
    watch: {
        params: {
            handler: throttle(function () {
                let params = pickBy(this.params);
                this.$inertia.get(this.route(this.sortRoute), params, {
                    replace: true,
                    preserveState: true,
                });
            }, 150),
            deep: true,
        },
    },
};
</script>
