<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import RolesSelect from "@/Components/AclRole/RolesSelect.vue";
import RoleDetails from "@/Components/AclRole/RoleDetails.vue";
import { ref, provide } from "vue";

const props = defineProps({
  aclData: Object,
});

const selectedRole = ref(props.aclData.aclRoles.data[0]);

provide("selectedRole", selectedRole);
provide("aclData", props.aclData);

/**
 * @param {object} role
 */
const selectRole = (role) => {
  selectedRole.value = role;
};
</script>

<template>
  <AppLayout :title="__('nav_permissions')">
    <div class="flex flex-col md:flex-row gap-4 mt-4">
      <RolesSelect @select-role="selectRole" />
      <RoleDetails />
    </div>
  </AppLayout>
</template>
