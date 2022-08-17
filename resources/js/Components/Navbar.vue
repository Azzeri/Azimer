<script setup>
import UserProfileButton from './UserProfileButton.vue';
import MainNavigation from './MainNavigation.vue';
import ResponsiveNavigation from './ResponsiveNavigation.vue';
import AppLogo from './AppLogo.vue';

</script>
<template>
  <div class="navbar bg-neutral text-neutral-content">
    <div class="navbar-start">
      <ResponsiveNavigation />
      <AppLogo />
    </div>
    <div class="navbar-center hidden lg:flex">
      <MainNavigation />
    </div>
    <div class="navbar-end">
      <UserProfileButton />
    </div>
  </div>
</template>