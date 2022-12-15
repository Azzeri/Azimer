<script setup>
defineProps({
    label: String,
    field: String,
    value: String,
    form: null,
});
</script>
<template>
    <div class="form-control w-full">
        <label v-if="label" class="label">
            <span class="label-text"> {{ label }} </span>
        </label>
        <input
            v-if="form"
            type="date"
            :placeholder="label"
            class="input input-bordered w-full"
            v-model="form[field]"
        />
        <input
            v-else
            disabled
            type="date"
            :placeholder="label"
            :value=value
            class="input input-bordered w-full"
        />
        <label v-if="form && form.errors[field]" class="label">
            <span class="label-text-alt text-red-600">{{
                form.errors[field]
            }}</span>
        </label>
    </div>
</template>
