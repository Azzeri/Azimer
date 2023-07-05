<script setup>
import { inject } from "vue";

defineEmits(["selectRole"]);
const aclData = inject("aclData");
const selectedRole = inject("selectedRole");
</script>
<template>
  <div class="acl-roles-card overscroll-contain max-h-60 md:max-h-max">
    <div class="card-body">
      <h2 class="card-title">{{ __("roles") }}</h2>
      <ul
        class="menu rounded max-h-44 flex-nowrap overflow-y-scroll bg-base-100 md:max-h-full md:h-full md:overflow-auto"
      >
        <li
          v-for="role in aclData.aclRoles.data"
          :key="role.suffix"
          @click="$emit('selectRole', role)"
        >
          <a :class="{ active: role.suffix == selectedRole.suffix }">
            {{ __(role.suffix) }}
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>
