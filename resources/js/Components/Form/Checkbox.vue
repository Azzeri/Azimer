<script setup>
defineProps({
    label: String,
    field: String,
    form: null,
});
</script>
<template>
    <div class="form-control w-full">
        <label class="label pl-0 justify-start space-x-2 cursor-pointer">
            <input type="checkbox" class="checkbox" v-model="form[field]" />
            <span class="label-text">{{ label }}</span>
        </label>
    </div>
</template>
