<script setup>
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    eqItem: Object,
});

const itemData = props.eqItem.data;

const serviceForms = [];
itemData.services.forEach((service) => {
    let form = useForm({});
    serviceForms.push(form);
});

const finishService = (index) => {
    const form = serviceForms[index];

    form.put(route("eqServices.finish", itemData.services[index].id));
};

const isDateAfterDue = (date) => {
    let dateNow = new Date();
    let parsedDate = Date.parse(date);

    return parsedDate < dateNow;
};
</script>
<template>
    <template class="grid grid-cols-4 gap-2">
        <form
            v-for="(service, index) in itemData.services"
            @submit.prevent="finishService(index)"
        >
            <div class="card w-86 bg-base-100 shadow">
                <div class="card-body">
                    <h2 class="card-title">
                        {{ service.eq_service_template.name }}
                    </h2>
                    <h3
                        class="font-semibold"
                        :class="{
                            'text-error': isDateAfterDue(
                                service.expected_perform_date
                            ),
                        }"
                    >
                        {{
                            `${__("expected")}: ${
                                service.expected_perform_date
                            }`
                        }}
                    </h3>
                    <p class="text-justify truncate">
                        {{ service.eq_service_template.description }}
                    </p>
                    <div class="card-actions justify-end">
                        <button
                            :disabled="serviceForms[index].processing"
                            type="submit"
                            class="btn btn-primary btn-sm"
                        >
                            {{ __("finish") }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </template>
</template>
