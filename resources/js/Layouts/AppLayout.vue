<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import Navbar from "../Components/Navbar.vue";
import FlashMessage from '@/Components/FlashMessage.vue';

defineProps({
    title: String,
});
</script>

<template>
    <Head :title="title" />
    <FlashMessage />
    <Navbar />
    <div class="container mx-auto bg-base-100 text-base-content">
        <slot />
    </div>
</template>
