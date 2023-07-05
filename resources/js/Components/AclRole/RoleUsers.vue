<script setup>
import { inject } from "vue";
const selectedRole = inject("selectedRole");
</script>
<template>
  <div class="acl-roles-card bg-base-100 overscroll-contain h-full rounded w-2/12">
    <div class="card-body">
      <h2 class="card-title">{{ __("users") }}</h2>
      <span v-if="!selectedRole.users.length">{{
        __("role_has_no_users")
      }}</span>
      <ul
        class="menu rounded flex-nowrap overflow-y-scroll bg-base-200 md:max-h-max md:overflow-auto"
      >
        <li v-for="user in selectedRole.users" :key="user.id">
          <a>{{ `${user.name} ${user.surname}` }}</a>
        </li>
      </ul>
    </div>
  </div>
</template>
