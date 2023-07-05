<script setup>
defineProps({
    label: String,
    field: String,
    form: Object,
    options: Array,
    selected: String | null,
});
</script>
<template>
    <div class="form-control w-full">
        <label v-if="label" class="label">
            <span class="label-text">{{ label }}</span>
        </label>
        <template v-if="form && field">
            <select v-model="form[field]" class="select select-bordered">
                <option v-if="!selected" :value="null">Brak</option>
                <template v-for="option in options" :field="option">
                    <option :value="option.value">{{ option.label }}</option>
                </template>
            </select>
            <label v-if="form.errors[field]" class="label">
                <span class="label-text-alt">{{ form.errors[field] }}</span>
            </label>
        </template>
        <template v-else>
            <select class="select select-bordered">
                <option v-if="!selected" :value="null">Brak</option>
                <template v-for="option in options" :field="option">
                    <option :value="option.value">{{ option.label }}</option>
                </template>
            </select>
        </template>
        
    </div>
</template>
