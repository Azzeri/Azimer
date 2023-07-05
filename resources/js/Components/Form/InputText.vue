<script setup>
defineProps({
  label: String,
  field: String,
  value: String,
  readonly: { type: Boolean, default: false },
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
      v-model="form[field]"
      :readonly="readonly"
      type="text"
      :placeholder="label"
      class="input input-primary input-bordered w-full"
    />
    <input
      v-else
      disabled
      type="text"
      :placeholder="label"
      :value="value"
      :readonly="readonly"
      class="input input-primary input-bordered w-full"
    />
    <label v-if="form && form.errors[field]" class="label">
      <span class="label-text-alt text-red-600">{{ form.errors[field] }}</span>
    </label>
  </div>
</template>
