<script setup>
import RoleUsers from "@/Components/AclRole/RoleUsers.vue";
import ResourcesForm from "@/Components/AclRole/ResourcesForm.vue";

defineEmits(["selectRole"]);
</script>
<template>
  <div class="acl-roles-card w-full">
    <div class="card-body">
      <div class="flex flex-col justify-between md:flex-row gap-2">
        <ResourcesForm />
        <RoleUsers />
      </div>
    </div>
  </div>
</template>
