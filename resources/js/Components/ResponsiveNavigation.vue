<script setup>
import Hamburger from '../Icons/Hamburger.vue';
import NavigationDropdownMenu from './NavigationDropdownMenu.vue';

</script>

<template>
<div class="dropdown bg">
  <label tabindex="0" class="btn btn-ghost lg:hidden">
    <Hamburger />
  </label>
    <NavigationDropdownMenu 
      listClass="menu 
        menu-compact 
        dropdown-content 
        mt-3 
        p-2 
        shadow 
        bg-base-100 
        text-base-content 
        rounded-box 
        w-52"
    />
</div>
</template>