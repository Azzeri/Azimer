<script setup>
defineProps({
    model: String,
    name: String,
    data: Array,
    form: null,
});
</script>
<template>
    <div class="form-control">
        <label class="label cursor-pointer">
            <span class="label-text">{{ __(data[0].label) }}</span>
            <input
                type="radio"
                :name="name"
                class="radio"
                value="last"
                v-model="form[model]"
            />
        </label>
    </div>
    <div class="form-control">
        <label class="label cursor-pointer">
            <span class="label-text">{{ __(data[1].label) }}</span>
            <input
                type="radio"
                :name="name"
                class="radio"
                value="next"
                v-model="form[model]"
            />
        </label>
    </div>
</template>
