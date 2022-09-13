<script setup>
defineProps({
    label: String,
    field: String,
    form: null,
});
</script>
<template>
    <div class="form-control w-full">
        <label v-if="label" class="label">
            <span class="label-text"> {{ label }} </span>
        </label>
        <input
            type="text"
            :placeholder="label"
            class="input input-bordered w-full"
            v-model="form[field]"
        />
        <label v-if="form.errors[field]" class="label">
            <span class="label-text-alt text-red-600">{{
                form.errors[field]
            }}</span>
        </label>
    </div>
</template>
