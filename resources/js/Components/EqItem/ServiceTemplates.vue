<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import Radio from "@/Components/Form/Radio.vue";
import InputDate from "@/Components/Form/InputDate.vue";

const props = defineProps({
    eqItem: Object,
});

const itemData = props.eqItem.data;

const serviceTemplateForms = [];
itemData.eqServiceTemplates.forEach((template) => {
    let form = useForm({
        eq_service_template_id: template.id,
        date_type: "last",
        date: null,
        last_service_date: null,
        next_service_date: null,
    });
    serviceTemplateForms.push(form);
});

const activateService = (index) => {
    const form = serviceTemplateForms[index];
    if (form.date_type === "last" && form.date) {
        form.last_service_date = form.date;
        form.next_service_date = null;
    }

    if (form.date_type === "next" && form.date) {
        form.next_service_date = form.date;
        form.last_service_date = null;
    }

    form.put(route("eqItems.activateService", itemData.code));
};
</script>
<template>
    <template class="grid grid-cols-4 gap-2">
        <form
            v-for="(serviceTemplate, index) in itemData.eqServiceTemplates"
            @submit.prevent="activateService(index)"
        >
            <div class="card w-86 bg-base-100 shadow">
                <div class="card-body">
                    <h2 class="card-title">{{ serviceTemplate.name }}</h2>
                    <h3 class="font-semibold">
                        {{ `${__("interval")}: ${serviceTemplate.interval}` }}
                    </h3>
                    <p class="text-justify truncate">
                        {{ serviceTemplate.description }}
                    </p>
                    <div class="divider"></div>
                    <Radio
                        :model="'date_type'"
                        :form="serviceTemplateForms[index]"
                        :name="`radio` + index"
                        :data="[
                            {
                                label: 'last service date',
                                value: 'last',
                            },
                            {
                                label: 'next service date',
                                value: 'next',
                            },
                        ]"
                    />
                    <InputDate
                        field="date"
                        :form="serviceTemplateForms[index]"
                    />
                    <div class="card-actions justify-end">
                        <button
                            :disabled="serviceTemplateForms[index].processing"
                            type="submit"
                            class="btn btn-primary btn-sm"
                        >
                            {{ __("activate") }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </template>
    <div class="divider" />
</template>
