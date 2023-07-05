<script setup>
import InputText from "@/Components/Form/InputText.vue";
import { inject } from "vue";
import { isRoleSuperAdmin } from "@/shared";

defineProps({
  form: null,
});

const selectedRole = inject("selectedRole");
</script>
<template>
  <div class="flex gap-2">
    <InputText
      :form="form"
      field="suffix"
      :readonly="isRoleSuperAdmin(selectedRole.suffix)"
    />
    <button
      v-if="!isRoleSuperAdmin(selectedRole.suffix)"
      type="submit"
      class="btn btn-square btn-primary"
      :class="{ loading: form.processing }"
    >
      <i v-if="!form.processing" class="fa-solid fa-check"></i>
    </button>
  </div>
</template>
