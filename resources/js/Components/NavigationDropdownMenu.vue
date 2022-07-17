<script setup>
import { navigation } from '../navigation';
import { Link } from '@inertiajs/inertia-vue3';

</script>
<template>
  <template v-for="nav in navigation" :key="nav">
      <li v-if="!nav.subNavigation">
        <Link :href="route(nav.link)">
          <i :class="nav.icon"></i>
          {{ nav.label }}
        </Link>
      </li>
      <li v-else :tabindex=nav.tabindex>
        <a>
          <i :class="nav.icon"></i>
          {{ nav.label }} 
        </a>
      <ul class="p-2 text-base-content bg-base-100 shadow">
        <li v-for="sub in nav.subNavigation" :key="sub">
          <Link :href="route(sub.link)">
            <i :class="sub.icon"></i>
            {{ sub.label }}
          </Link>
        </li>
      </ul>
      </li>
    </template>
</template>